<?php

global $_W;
$lunbo=pdo_fetchall("SELECT * FROM".tablename('hulu_list_lunbo')."WHERE uniacid=:uniacid ORDER BY lid DESC",array(':uniacid'=>$_W['uniacid']));
include $this->template('add');

?>