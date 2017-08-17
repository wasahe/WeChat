<?php
/**
 * �׿;���ģ��΢վ����
 *
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT . '/addons/yike_guess/yike/defines.php';
require "../addons/yike_guess/inc/functions.php";
class Yike_guessModuleSite extends WeModuleSite {

	// public function doMobileIndex() {
	// 	//��������������������� ���ܷ���
	// }
	public function payResult($params) {
		global $_W;
        if (!empty($params['uniontid'])) {
            $uniontid = $params['uniontid'];
            $order = pdo_get('core_paylog', array('uniontid' => $uniontid));
        } elseif (!empty($params['tid'])) {
            $tid = $params['tid'];
            $order = pdo_get('core_paylog', array('tid' => $tid));
        }
        $id = $order['tid'];
        $result = pdo_fetch('select * from '.tablename('yike_guess_recharge').' where id = :id', array(':id' => $id));
        if (floatval($result['money']) != floatval($params['card_fee'])) {
            message('����֧�����', $this->createMobileUrl('index', array()), 'error');
            return false;
        }
	    if ($params['result'] == 'success' && $params['from'] == 'notify') {
	    	$user = pdo_fetch('select credit1 from '.tablename('mc_members').' where uid = :uid',array(':uid' => $params['user']));
	    	pdo_update('yike_guess_recharge', array('status' => 1), array('id' => $id));
            $data1 = array(
            	'uniacid' => $_W['uniacid'],
            	'uid' => $_W['member']['uid'],
            	'balance' => $user['credit1'] + $params['card_fee'],
            	'type' => 1,
            	'money' => $params['fee'],
            	'create_time' => time(),
            	'name' => '��ֵ'
            );
            pdo_insert('yike_guess_balance', $data1);
            $data2 = array(
            	'uid' => $_W['member']['uid'],
            	'uniacid' => $_W['uniacid'],
            	'time' => time(),
            	'way' => '΢��',
            	// 'state' => 2,
            	'money' => $params['fee']
            );
            pdo_insert('yike_guess_money',$data2);
            $data = array(
                'credit1' => $user['credit1'] + $params['card_fee']
            );
            pdo_update('mc_members',$data,array(
                'uid' => $params['user']
            ));
            message('��ֵ�ɹ���', $this->createMobileUrl('index', array()), 'success');
	    }
	    
	    if (empty($params['result']) || $params['result'] != 'success') {
        }

	    if ($params['from'] == 'return') {
	    	
	       	if ($params['result'] == 'success') {
                message('��ֵ�ɹ���', $this->createMobileUrl('index', array()), 'success');
            } else {
                message('��ֵʧ�ܣ�', $this->createMobileUrl('index', array()), 'error');
            }
	    }
	}

}