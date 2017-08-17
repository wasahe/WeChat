<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
include MODULE_ROOT.'/inc/mobile/pc_init.php';
$mobiles = pdo_fetchall("SELECT `mobile` FROM ".tablename($this->user_table)." WHERE weid=:weid AND rid=:rid AND mobile!=:mobile AND isblacklist=:isblacklist",array(':weid'=>$weid,':rid'=>$rid,':mobile'=>'',':isblacklist'=>'1'));
if(!empty($mobiles) && is_array($mobiles)){
	foreach($mobiles as &$row){
		$row['mobile'] = preg_replace('/(\d{3})\d{4}(\d{4})/', '$1****$2', $row['mobile']); 
	}
	unset($row);
}
include $this->template('xysjh');