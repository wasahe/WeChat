<?php
/*
 * 源码来自悟空源码网
 * www.5kym.com
 */

if (PHP_SAPI == 'cli')

    die('This example should only be run from a Web Browser');

global $_GPC,$_W;

$weid=$_W['uniacid'];



$list= pdo_fetchall("select * from ".tablename('amouse_rebate_order')." where uniacid=:uniacid order by createtime desc ",array(':uniacid'=>$weid));



$tableheader = array($this->encode( "订单号"),$this->encode( "姓名"),$this->encode("Openid"),

	$this->encode("用户名"),$this->encode("购买详情"),$this->encode("支付金额"),$this->encode("状态"),

	$this->encode("下单时间"),

	$this->encode("支付时间"));





$html = "\xEF\xBB\xBF";

foreach ($tableheader as $value) {

	$html .= $value . "\t ,";

}

$html .= "\n";

foreach ($list as $value) {



	if($value['mealid']>0){

		$meal= pdo_fetchcolumn('SELECT * FROM '.tablename('amouse_rebate_meal')." WHERE id=:id  ", array(':id' => $value['mealid']));

	}

	if($value['uid']>0){

		$goods= pdo_fetchcolumn('SELECT title FROM '.tablename('amouse_rebate_goods')." WHERE uniacid =$weid and id=:id ", array(':id' => $value['uid']));

	}



	if($value['status'] == 0){

		$txt="已下单";

	}elseif($value['status'] == 1){

		$txt="已付款";

	}elseif($value['status'] == 2){

		$txt="已发货";

	}

	$title = empty($meal) == $goods ? : $meal;

	$html .= $this->encode($value['ordersn']) . "\t ,";

	$html .= $this->encode($value['nickname']) . "\t ,";

	$html .= $value['openid'] . "\t ,";

	$html .=$this->encode($value['username']). "\t ,";

	$html .=$this->encode($title) . "\t ,";

	$html .=$value["price"]  . "\t ,";

	$html .=$this->encode($txt)  . "\t ,";

	$html .= ($value['createtime'] == 0 ? '' : date('Y-m-d H:i',$value['createtime'])) . "\t";

	$html .= ($value['notifytime'] == 0 ? '' : date('Y-m-d H:i',$value['notifytime'])) . "\n";



}





header("Content-type:text/csv;charset=UTF-8");

header("Content-Disposition:attachment; filename=订单数据.csv");



echo $html;

exit();

