<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/14
 * Time: 15:22
 */
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
load()->func('tpl');
$uniacid=$_W['uniacid'];
if($op=='display'){
    $params=array();
    if(!empty($_GPC['keyword'])){
        $condition .= " and title LIKE :keyword";
        $params[':keyword'] = "%{$_GPC['keyword']}%";
    }
    $pindex= max(1, intval($_GPC['page']));
    $psize=10;
    $sql="select * from ".tablename('dg_prorec')." where uniacid=:uniacid ".$condition." order by id desc limit ".intval($pindex-1)*$psize.",".$psize;
    $params[':uniacid']=$uniacid;
    $list=pdo_fetchall($sql,$params);
    $total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('dg_prorec')." WHERE uniacid =:uniacid",array(":uniacid"=>$uniacid));
    $pager = pagination($total, $pindex, $psize);
}elseif($op=='post'){
    $templist=pdo_fetchall("select * from ".tablename('dg_prorectemp')." where uniacid=$uniacid and tempstatus=2");
    $id=intval($_GPC['id']);
    $category=pdo_fetchall("select * from".tablename('dg_proreccate')." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
    if($id>0){
        $item=pdo_fetch("select * from".tablename('dg_prorec')." where id=:id",array(":id"=>$id));
        $protemp=@json_decode($item['template'],true);
        $protempid=$item['tempid'];
        if(empty($item)){
            message('抱歉，文章不存在或是已经删除！', '', 'error');
        }
    }
    if(checksubmit('submit')){
        empty($_GPC['cate']) ? message('亲，请选择分类'): $_GPC['cate'];
        $temindex=intval($_GPC['template']);
        $localtemp=@json_decode($templist[$temindex]['templist'],true);
        $tempcount=count($localtemp['keyword']);
        $temp=array(
            'template_id'=>$templist[$temindex]['tempid'],
            'first'=>$_GPC['first'],
            'remark'=>$_GPC['remark']
        );
        for($i=0;$i<$tempcount;$i++){
            $temp['keyword'.$i]=$_GPC['keyword'.$i];
            }
        $tempcontent=@json_encode($temp,JSON_UNESCAPED_UNICODE);
        $color=@json_encode($_GPC['color'],JSON_UNESCAPED_UNICODE);
        $data=array(
            'cateid'=>$_GPC['cate'],
            'catename'=>$_GPC['catename'],
            'title'=>$_GPC['title'],
            'uniacid'=>$uniacid,
            'content'=>htmlspecialchars_decode($_GPC['content']),
            'template'=>$tempcontent,
            'tempid'=>$templist[$temindex]['tempid'],
            'color'=>$color,
            'url'=>$_GPC['url'],
            'createtime'=>TIMESTAMP
        );
        if(empty($id)){
            pdo_insert('dg_prorec',$data);
        }else{
            pdo_update('dg_prorec',$data,array('id'=>$_GPC['id']));
        }
        message('文章更新成功！',$this->createWebUrl('message',array('op'=>'display')), 'success');
    }

}
if($op=='on'){
    ignore_user_abort();
    set_time_limit(0);
    $id=intval($_GPC['id']);
    $mess=pdo_fetch("select * from ".tablename('dg_prorec')." where id=:id",array(':id'=>$id));
    $status=$mess['status'];
    $messtemp=@json_decode($mess['template'],true);
    $result=array();
    $result['res']=0;
    if($status==1){
        $data=array(
            'status'=>2,
            'createtime'=>TIMESTAMP
        );
        $cateid=$mess['cateid'];
        $usersql="select * from ".tablename('dg_prorecuser')." where cateid=:cateid and uniacid=:uniacid and followstatus=2";
        $parms=array(":cateid"=>$cateid,":uniacid"=>$uniacid);
        $userall=pdo_fetchall($usersql,$parms);
        $template_id=$messtemp['template_id'];
        $first=$messtemp['first'];
        $remark=$messtemp['remark'];
        $keycount=intval(count($messtemp)-3);
        $color=@json_decode($mess['color'],true);
        for($i=0;$i<$keycount;$i++){
            $j=$i+1;
            $key['keyword'.$j]['value']=$messtemp['keyword'.$i];
            if(!empty($color[$j])){
                $key['keyword'.$j]['color']=$color[$j];
            }
        }
        !empty($color[0]) ? $color[0] :"#000";
        !empty($color[count($color)-1]) ? $color[count($color)-1] :"#000";
        $post = array(
            'first' => array(
                'value'=>$first,
                'color'=>$color[0]
            ),
            'remark' => array(
                'value'=>$remark,
                'color'=>$color[count($color)-1]
            ),
        );
        $temppost=array_merge($post,$key);
        ksort($temppost);
        if(empty($mess['url'])){
            $url=$_W['siteroot'].'app/'.substr($this->createmobileurl('single',array('id'=>$mess['cateid'])),2);
        }else{
            $url=$mess['url'];
        }

        foreach ($userall as $item) {
            $this->sendTplNotice($item['openid'], $template_id, $temppost,$url);
        }
        $res=pdo_update('dg_prorec',$data,array("id"=>$id));
        $result['res']=$res;
    }
    header("Content-type:application/json");
    echo json_encode($result);
    exit();
}
if($op=='delete'){
    $id=intval($_GPC['id']);
    pdo_delete('dg_prorec',array('id'=>$id));
    message('删除成功！', referer(), 'success');
}
include $this->template('message');