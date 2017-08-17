<?php

global $_W;
if($_W['ispost']){

}else{
	$lunbo=pdo_fetchall("SELECT * FROM".tablename('hulu_list_lunbo')."WHERE uniacid=:uniacid ORDER BY lid DESC",array(':uniacid'=>$_W['uniacid']));
	
load()->func('tpl');
include $this->template('lunbo');
}

?>