<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/21
 * Time: 11:39
 */
global $_W,$_GPC;
$tet=$_GPC['tet'];
$uniacid=$_W['uniacid'];
if($tet==''){
    exit();
}
load()->func('tpl');
$templist=pdo_fetchall("select * from ".tablename('dg_prorectemp')." where uniacid=$uniacid and tempstatus=2");
$temp=@json_decode($templist[$tet]['templist'],true);
for($i=0;$i<count($temp['keyword']);$i++){
    $temp['send'][]=explode("：",$temp['keyword'][$i]);
}
$res=array();

    $first=tpl_form_field_color('color[]','');

$str=<<<STR
<div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板标题</label>
                    <div class="col-md-9" style="padding-left:0;">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="{$temp['first']}" name="first" value="">
                        </div>
                        <div class="col-md-3">
                            $first
                        </div>
                    </div>
                </div>
STR;
foreach($temp['send'] as $index => $item){
    $str.="
<div class=\"form-group\">
                    <label class=\"col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label\">{$item[0]}</label>
                    <div class=\"col-md-9\" style=\"padding-left:0;\">
                    <div class=\"col-sm-8\">
                        <input type=\"text\" class=\"form-control\" placeholder=\"{$item[1]}\" name=\"keyword$index\" value=\"\">
                    </div>
                    <div class=\"col-md-3\">
                            $first
                        </div>
                    </div>
                </div>
    ";
}

$str.=<<<STR
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">模板详情</label>
                    <div class="col-md-9" style="padding-left:0;">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="{$temp['remark']}" name="remark" value="">
                        </div>
                        <div class="col-md-3">
                               $first
                            </div>
                    </div>
                </div>
STR;

$str.=<<<STR
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">示例:</label>
                      <div class="col-sm-8 col-xs-12">
                        <textarea name="example" class="form-control" cols="200" rows="8" readonly="readonly" >{$templist[$tet]['tempexple']}</textarea>
                    </div>
                </div>

STR;


echo $str;
