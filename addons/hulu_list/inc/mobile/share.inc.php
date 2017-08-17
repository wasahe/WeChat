<?php

global $_W,$_GPC;

$info=pdo_fetch("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND id=:vid",array(':uniacid'=>$_W['uniacid'],':vid'=>$_GPC['vid']));
$codehu=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));

if($info['list']=='1'){$hulu='a1.jpg';	$_W['page']['title']=$info['jobfactory'].',招聘'.$info['jobname'].',薪资范围'.$info['jobsalary'].',联系电话是...';	}

if($info['list']=='2'){	$hulu='a2.jpg';$_W['page']['title']=$info['houseaddress'].',现有'.$info['housetype'].',价格在'.$info['houseprice'].',联系电话是...';	include $this->template('house');}

if($info['list']=='3'){	$hulu='a3.jpg';$_W['page']['title']='现有'.$info['ershounewor'].$info['ershoupinpai'].$info['ershouname'].',价格在'.$info['ershouprice'].',联系电话是...';	include $this->template('old');}

if($info['list']=='4' ){	$hulu='a4.jpg';$_W['page']['title']='【车找人】'.$info['chestart'].'到'.$info['cheend'].'可带'.$info['cheperson'].'人'.'出发时间是'.date("m月d日,H:i",strtotime($info['validity'])).',联系电话是...';	include $this->template('chea');}

if($info['list']=='5' ){$hulu='a4.png';	$_W['page']['title']='【人找车】'.$info['chestart'].'到'.$info['cheend'].'有'.$info['cheperson'].'人搭乘'.'出发时间是'.date("m月d日,H:i",strtotime($info['validity'])).',联系电话是...';	include $this->template('cheb');}

if($info['list']=='6'){$hulu='a5.jpg';	$_W['page']['title']='我是'.$info['linshiname'].$info['linshispecial'].'想找临时工作,联系电话是...';	
include $this->template('work');}



$_share=array(
'title'=>$_W['page']['title'],
'imgUrl'=>$_W['siteroot'].'addons/hulu_list/template/mobile/images/'.$hulu,
'content'=>$_W['page']['title'],

);
if($info['list']=='1'){include $this->template('job');}

?>
