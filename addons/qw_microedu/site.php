<?php
defined('IN_IA') or die('Access Denied');
class Qw_microeduModuleSite extends WeModuleSite
{
	public function payResult($params)
	{
		global $_W;
		if ($params['result'] == 'success' && $params['from'] == 'notify') {
			$sql = "SELECT p.consultant_id,co.rate FROM " . tablename('qw_microedu_users') . " AS u LEFT JOIN " . tablename('qw_microedu_parents') . " AS p ON u.role_id=p.id LEFT JOIN " . tablename('qw_microedu_consultants') . " AS co ON p.consultant_id=co.id " . " WHERE u.uniacid=:uniacid AND u.openid=:openid AND u.role_type=:role_type ";
			$user_params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid'], ':role_type' => 'parents');
			$user = pdo_fetch($sql, $user_params);
			$rate = $user['rate'];
			$user_consultant_id = $user['consultant_id'];
			$tid = $params['tid'];
			$transaction_id = $params['tag']['transaction_id'];
			$uniacid = $params['uniacid'];
			$card_fee = $params['card_fee'];
			pdo_update('qw_microedu_transactions', array('status' => '1', 'gateway_transaction_id' => $transaction_id), array('id' => $tid));
			pdo_update('qw_microedu_invoices', array('status' => '1'), array('transaction_id' => $tid));
			$sql = "SELECT id,item_price,parentscontracts_id FROM " . tablename('qw_microedu_invoices') . " WHERE uniacid=:uniacid AND transaction_id=:transaction_id";
			$params1 = array(':uniacid' => $uniacid, ':transaction_id' => $tid);
			$res = pdo_fetchall($sql, $params1);
			foreach ($res as $key => $val) {
				$sql = " SELECT contract_id,status,contract_enddate FROM " . tablename('qw_microedu_parentscontracts') . " WHERE uniacid=:uniacid AND id=:id ";
				$params2 = array(':uniacid' => $uniacid, ':id' => $val['parentscontracts_id']);
				$parentscontract = pdo_fetch($sql, $params2);
				if (!empty($parentscontract)) {
					$sql = " SELECT contract_duration FROM " . tablename('qw_microedu_contracts') . " WHERE uniacid=:uniacid AND id=:id ";
					$params3 = array(':uniacid' => $uniacid, ':id' => $parentscontract['contract_id']);
					$contract = pdo_fetch($sql, $params3);
					if (!empty($contract)) {
						if ($parentscontract['status']) {
							$contract_enddate = date('Y-m-d', strtotime($parentscontract['contract_enddate']) + $contract['contract_duration'] * 24 * 60 * 60);
							pdo_update('qw_microedu_parentscontracts', array('contract_enddate' => "{$contract_enddate}"), array('id' => $val['parentscontracts_id']));
							$sql = " SELECT classhour_id,amount FROM " . tablename('qw_microedu_contractsclasshours') . " WHERE uniacid=:uniacid AND contract_id=:contract_id ";
							$params4 = array(':uniacid' => $uniacid, ':contract_id' => $parentscontract['contract_id']);
							$contractsclasshours = pdo_fetchall($sql, $params4);
							if (!empty($contractsclasshours)) {
								foreach ($contractsclasshours as $key => $value) {
									$sql = "SELECT amount FROM " . tablename('qw_microedu_parentsremainingclasshours') . " WHERE uniacid=:uniacid AND parentscontract_id=:parentscontract_id AND classhour_id=:classhour_id";
									$where = array('uniacid' => $uniacid, 'parentscontract_id' => $val['parentscontracts_id'], 'classhour_id' => $value['classhour_id']);
									$parentsremainingclasshours = pdo_fetch($sql, $where);
									if (!empty($parentsremainingclasshours)) {
										$amount = $parentsremainingclasshours['amount'] + $value['amount'];
										$data = array('amount' => $amount);
										pdo_update('qw_microedu_parentsremainingclasshours', $data, $where);
									}
								}
							}
						} else {
							$sql = " SELECT classhour_id,amount FROM " . tablename('qw_microedu_contractsclasshours') . " WHERE uniacid=:uniacid AND contract_id=:contract_id ";
							$params5 = array(':uniacid' => $uniacid, ':contract_id' => $parentscontract['contract_id']);
							$contractsclasshours = pdo_fetchall($sql, $params5);
							if (!empty($contractsclasshours)) {
								foreach ($contractsclasshours as $key => $value) {
									$data1 = array('uniacid' => $uniacid, 'parentscontract_id' => $val['parentscontracts_id'], 'classhour_id' => $value['classhour_id'], 'amount' => $value['amount']);
									pdo_insert('qw_microedu_parentsremainingclasshours', $data1);
								}
							}
							pdo_update('qw_microedu_parentscontracts', array('status' => '1'), array('id' => $val['parentscontracts_id']));
						}
						$money = $val['item_price'] / 100 * $rate;
						$invoices_date = array('uniacid' => $uniacid, 'consultant_id' => $user_consultant_id, 'invoice_id' => $val['id'], 'amount' => round($money, 2));
						pdo_insert('qw_microedu_commissions', $invoices_date);
					}
				}
			}
			$uniacid = $_W['uniacid'];
			$settings = pdo_fetchcolumn("SELECT settings FROM" . tablename('uni_account_modules') . "WHERE uniacid='{$uniacid}' and module='qw_microedu'");
			$set = iunserializer($settings);
			$templid = $set['purch_tplid'];
			$tplurl = "";
			$openid = $res['openid'];
			$content = array("first" => array("value" => "您已成功购买合同"), "keyword1" => array("value" => "家长购买合同操作"), "keyword2" => array("value" => "购买成功"), "remark" => array("value" => "谢谢"));
			load()->classs('weixin.account');
			load()->func('communication');
			$obj = new WeiXinAccount();
			$access_token = $obj->fetch_available_token();
			$data = array('touser' => $openid, 'template_id' => $templid, 'url' => $tplurl, 'topcolor' => "#FF0000", 'data' => $content);
			$json = json_encode($data);
			$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
			$ret = ihttp_post($url, $json);
		}
		if ($params['from'] == 'return') {
			if ($params['result'] == 'success') {
				message('支付成功！', $this->createMobileurl('parent', array('page' => 'index')), 'success');
			} else {
				message('支付失败！', $this->createMobileurl('parent', array('page' => 'index')), 'error');
			}
		}
	}
}