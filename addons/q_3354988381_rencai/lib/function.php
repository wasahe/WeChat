<?php 
	function L($info){
            load()->func('logging');
            logging_run($info);
	}    
	//读取当前会员的资料：
	function get_member_info(){
		global $_W;
		load()->model('mc');
		$uid = (int)$_W['member']['uid'];
		$member = mc_fetch($uid);
		return $member;
	}
?>