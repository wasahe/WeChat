<?php

global $_W;


if($_W['container']=='wechat'){
	if($_W['fans']['follow']=='1'){
$fans=$_W['fans'];

$all=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND openid=:openid AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':openid'=>$_W['fans']['openid']));

include $this->template('my');

	}else{
	$follow=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
	echo $follow['follow'];

}
}else{
	$open=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
	echo $open['open'];
	

}
?>