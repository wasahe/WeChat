<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
include MODULE_ROOT.'/inc/mobile/pc_init.php';
$man  = pdo_fetchall("SELECT * FROM ".tablename($this->user_table)." WHERE rid=:rid AND weid = :weid AND isblacklist=:isblacklist AND sex=:sex AND status=:status",array(':rid'=>$rid,':weid'=>$weid,':isblacklist'=>'1',':sex'=>'1',':status'=>'1'));
$woman  = pdo_fetchall("SELECT * FROM ".tablename($this->user_table)." WHERE rid=:rid AND weid = :weid AND isblacklist=:isblacklist AND sex=:sex AND status=:status",array(':rid'=>$rid,':weid'=>$weid,':isblacklist'=>'1',':sex'=>'2',':status'=>'1'));
include $this->template('ddp');