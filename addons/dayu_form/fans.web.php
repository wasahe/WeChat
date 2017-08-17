<?php
//decode by QQ:3213288469 http://www.zheyitianshi.com/
		$weid = $_W['uniacid'];
		
		$_accounts = $accounts = uni_accounts();
		load()->model('mc');
		if(empty($accounts) || !is_array($accounts) || count($accounts) == 0){
			message('请指定公众号');
		}
		if(!isset($_GPC['acid'])){
			$account = array_shift($_accounts);
			if($account !== false){
				$acid = intval($account['acid']);
			}
		} else {
			$acid = intval($_GPC['acid']);
			if(!empty($acid) && !empty($accounts[$acid])) {
				$account = $accounts[$acid];
			}
		}
		reset($accounts);