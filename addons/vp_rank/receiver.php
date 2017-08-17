<?php
/**
 * 友配模块订阅器
 *
 * @author vpower
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Vp_rankModuleReceiver extends WeModuleReceiver {
	public function receive() {
		global $_W;

		//$type = $this->message['type'];

		//if('event'==$type){
			$event = $this->message['event'];
			if('subscribe'==$event){
				load()->model('mc');
				$this->_fan = mc_fansinfo($this->message['from'], $_W['acid'], $_W['uniacid']);
				if(!empty($this->_fan)  && $this->_fan['uid']>0){
					pdo_update('vp_rank_user', array('followed'=>1,'follow'=>1), array('uid' =>$this->_fan['uid'], 'uniacid' => $_W['uniacid']));
				}
			}else if('unsubscribe'==$event){
				load()->model('mc');
				$this->_fan = mc_fansinfo($this->message['from'], $_W['acid'], $_W['uniacid']);
				// 
				if(!empty($this->_fan)  && $this->_fan['uid']>0){
					pdo_update('vp_rank_user', array('follow'=>0), array('uid' =>$this->_fan['uid'], 'uniacid' => $_W['uniacid']));
				}
			}
		//}

	}
}