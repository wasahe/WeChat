<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/22
 * Time: 15:04
 */
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$temp=$this->tplAll();
if(checksubmit()){
    if(!empty($_GPC['tempindex'])){
        function change_to_quotes($str) {
            return sprintf("'%s'", $str);
        }
        $ss=implode(',',array_map('change_to_quotes',$_GPC['tempindex']));
        $cltemp=pdo_fetchall("select tempid from ".tablename('dg_prorectemp')." where uniacid=$uniacid and tempstatus=2");
        if(empty($cltemp)){
            foreach($_GPC['tempindex'] as $key=>$item){
                tianjia($key,$item,$uniacid,$temp);
            }
        }else{
            foreach ($cltemp as $item) {
                $ctemplateid[]=$item['tempid'];
            }
            if(count($ctemplateid)>count($_GPC['tempindex'])){
                $uptemp=array_diff($ctemplateid,$_GPC['tempindex']);
            }else{
                $uptemp=array_diff($_GPC['tempindex'],$ctemplateid);
            }
            if(count($uptemp)>=1){
                foreach ($uptemp as $key=>$item) {
                    $istemp=pdo_fetch("select * from ".tablename('dg_prorectemp')." where tempid='".$item."'");
                    if(!empty($istemp)){
                        if($istemp['tempstatus']==1){
                            update($key,$item,$uniacid,$temp);
                        }else{
                            del($key,$item,$uniacid,$temp);
                        }
                    }else{
                        tianjia($key,$item,$uniacid,$temp);
                    }
                }
            }else{
                foreach($_GPC['tempindex'] as $key=>$item){
                    del($key,$item,$uniacid,$temp);
                }
            }

        }
        message('本地模板添加成功',referer(),"success");
    }else{
        message('本地模板选择之后,至少要存在一个',referer(),"error");
    }
}
$ltemp=pdo_fetchall("select tempid from ".tablename('dg_prorectemp')." where uniacid=$uniacid and tempstatus=2");
foreach ($ltemp as $item) {
    $templateid[]=$item['tempid'];
}
function tianjia($key,$template,$uniacid,$temp){
    $localtemp=array(
        'template_id'=>$template,
        'first'=>$temp[$key]['first'],
        'remark'=>$temp[$key]['remark'],
        'keyword'=>$temp[$key]['keyword']
    );
    $tempcontent=@json_encode($localtemp,JSON_UNESCAPED_UNICODE);
    $data=array(
        'uniacid'=>$uniacid,
        'tempid'=>$template,
        'tempname'=>$temp[$key]['title'],
        'templist'=>$tempcontent,
        'tempexple'=>$temp[$key]['example'],
        'tempstatus'=>2,
        'createtime'=>TIMESTAMP
    );
    pdo_insert('dg_prorectemp',$data);
}
function update($key,$template,$uniacid,$temp){
    $localtemp=array(
        'template_id'=>$template,
        'first'=>$temp[$key]['first'],
        'remark'=>$temp[$key]['remark'],
        'keyword'=>$temp[$key]['keyword']
    );
    $tempcontent=@json_encode($localtemp,JSON_UNESCAPED_UNICODE);
    $data=array(
        'uniacid'=>$uniacid,
        'tempid'=>$template,
        'tempname'=>$temp[$key]['title'],
        'templist'=>$tempcontent,
        'tempexple'=>$temp[$key]['example'],
        'tempstatus'=>2,
        'createtime'=>TIMESTAMP
    );
    pdo_update('dg_prorectemp',$data,array('tempid'=>$template));
}
function del($key,$template,$uniacid,$temp){
    $localtemp=array(
        'template_id'=>$template,
        'first'=>$temp[$key]['first'],
        'remark'=>$temp[$key]['remark'],
        'keyword'=>$temp[$key]['keyword']
    );
    $tempcontent=@json_encode($localtemp,JSON_UNESCAPED_UNICODE);
    $data=array(
        'uniacid'=>$uniacid,
        'tempid'=>$template,
        'tempname'=>$temp[$key]['title'],
        'templist'=>$tempcontent,
        'tempexple'=>$temp[$key]['example'],
        'tempstatus'=>1,
        'createtime'=>TIMESTAMP
    );
    pdo_update('dg_prorectemp',$data,array('tempid'=>$template));
}
include $this->template('settemp');
