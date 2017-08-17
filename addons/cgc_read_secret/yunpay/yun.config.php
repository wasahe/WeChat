<?php
 //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
require_once '../../../framework/bootstrap.inc.php';
$_W['uniacid'] = $_POST['uniacid'];
$site = WeUtility::createModuleSite('cgc_read_secret');
if(is_error($site)) {
	WeUtility::logging('cgc_read_secret yun.config', "site error");
	exit('fail');
}

$setting = $site->module['config'];

//合作身份者id
$yun_config['partner']		= $setting['yunpay_pid'];

//安全检验码
$yun_config['key']			= $setting['yunpay_key'];

//云会员账户（邮箱）
$seller_email = $setting['yunpay_no'];

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

?>