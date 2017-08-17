<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/14
 * Time: 16:07
 */
global $_W,$_GPC;
load()->func('tpl');
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$uniacid=$_W['uniacid'];
if($op=='post'){
    $id=intval($_GPC['id']);
    $category=pdo_fetch("select * from ".tablename('dg_proreccate')." where id=:id",array(":id"=>$id));
    $catetag=explode(",",$category['tags']);
    $subcount=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorecuser')." where cateid=:id and followstatus=2",array(":id"=>$id));
    $tags=pdo_fetchall("select * from ".tablename('dg_prorectags')." where uniacid=:uniacid order by id desc",array(":uniacid"=>$uniacid));
    if(checksubmit()){
        $tag=implode(",",$_GPC['tags']);
        $count=intval($subcount+$_GPC['fcount']);
        $data=array(
            'uniacid'=>$uniacid,
            'displayid'=>$_GPC['displayid'],
            'name'=>$_GPC['name'],
            'icon'=>$_GPC['icon'],
            'attpro'=>htmlspecialchars_decode($_GPC['attpro']),
            'buyurl'=>$_GPC['buyurl'],
            'rename'=>$_GPC['rename'],
            'fcount'=>$_GPC['fcount'],
            'createtime'=>TIMESTAMP,
            'tags'=>$tag,
            'money'=>$_GPC['money'],
            'count'=>$count
        );
        if($id>0){
            pdo_update('dg_proreccate',$data,array('id'=>$id));
        }else{
            pdo_insert('dg_proreccate',$data);
        }
        message('设置成功',$this->createweburl('messlist',array('op'=>'display')),'success');
    }
}elseif($op=='display'){
    if(checksubmit()){
        if (!empty($_GPC['displayid'])) {
            foreach ($_GPC['displayid'] as $key => $displayorder) {
                $update = array('displayid' => intval($displayorder));
                pdo_update('dg_proreccate', $update, array('id' => $key));
            }
            message('产品排序更新成功！', 'refresh', 'success');
        }
    }
    $category=pdo_fetchall("select * from ".tablename('dg_proreccate')." where uniacid=:uniacid order by displayid desc",array(":uniacid"=>$uniacid));
}elseif($op=='delete'){
    $id = intval($_GPC['id']);
    pdo_delete('dg_proreccate', array('id' => $id));
    message('产品删除成功！', $this->createWebUrl('messlist', array('do' => 'display')), 'success');
}
include $this->template('messlist');