<?php
 

global $_GPC;
global $_W;
$uniacid = $_W['uniacid'];
$settings = $this->module['config'];
$modulename = $this->modulename;
$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));

if ($op == 'display') {
	if (empty($_SESSION['forward'])) {
		exit('ddd');
	}


	$succ_url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&j=' . $_W['acid'] . '&c=entry&m=' . $this->modulename . '&do=enter&form=follow';
	$share_url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&j=' . $_W['acid'] . '&c=entry&m=' . $this->modulename . '&do=enter&form=question';
	$settings['share_url'] = ((!empty($settings['share_url']) ? $settings['share_url'] : $share_url));
	$settings['share_url'] = get_random_domain($settings['share_url']);
	$settings['succ_url'] = ((!empty($settings['succ_url']) ? $settings['succ_url'] : $succ_url));
	$settings['succ_url'] = get_random_domain($settings['succ_url']);
	include $this->template('question');
	exit();
}


?>