<?php
 

global $_W;
global $_GPC;
require MD_ROOT . '/source/Model.class.php';
require MD_ROOT . '/source/VpRankModel.class.php';
$cmd = $_GPC['cmd'];
$rank_id = $_GPC['rank_id'];

if (empty($rank_id)) {
	returnError('请选择要操作的圈子');
}


$rank = pdo_fetch('select * from ' . tablename('vp_rank') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $rank_id));

if (empty($rank)) {
	returnError('该圈子不存在');
}


$menus = ((empty($rank['menus']) ? array() : iunserializer($rank['menus'])));

if ($cmd == 'add') {
	if ('add' == $_GPC['submit']) {
		$menu = $_GPC['menu'];

		if (empty($menu['code'])) {
			return $this->returnError('请填写菜单标识');
		}


		foreach ($menus as $mn ) {
			if (!($mn['code'] == $menu['code'])) {
				continue;
			}
			return $this->returnError('该菜单标识已存在');
		}

		if (empty($menu['name'])) {
			return $this->returnError('请填写菜单名称');
		}


		if (6 < text_len($menu['name'])) {
			return $this->returnError('名称大长了，不要超过6个字');
		}


		$menus[] = $menu;
		$menus = array_sort($menus, 'sort');
		$ret = pdo_update('vp_rank', array('menus' => iserializer($menus)), array('id' => $rank['id']));

		if ($ret === false) {
			return $this->returnError('菜单新增失败');
		}


		$rank_cache_key = 'vap_rank:' . $rank['id'];
		cache_delete($rank_cache_key);
		returnSuccess('菜单项新增成功!', $this->createWebUrl('menu', array('rank_id' => $rank_id)));
		return 1;
	}


	include $this->template('web/menu_add');
	return 1;
}


if ($cmd == 'edit') {
	if ('edit' == $_GPC['submit']) {
		$menu = $_GPC['menu'];

		if (empty($menu['code'])) {
			return $this->returnError('请填写菜单标识');
		}


		if (empty($menu['name'])) {
			return $this->returnError('请填写菜单名称');
		}


		if (6 < text_len($menu['name'])) {
			return $this->returnError('名称大长了，不要超过6个字');
		}


		$i = 0;

		while ($i < count($menus)) {
			if ($menus[$i]['code'] == $menu['code']) {
				$menus[$i] = $menu;
			}


			++$i;
		}

		$menus = array_sort($menus, 'sort');
		$ret = pdo_update('vp_rank', array('menus' => iserializer($menus)), array('id' => $rank['id']));

		if ($ret === false) {
			return $this->returnError('菜单保存失败');
		}


		$rank_cache_key = 'vap_rank:' . $rank['id'];
		cache_delete($rank_cache_key);
		returnSuccess('菜单保存成功!', $this->createWebUrl('menu', array('rank_id' => $rank_id)));
		return 1;
	}


	$code = $_GPC['code'];

	if (empty($code)) {
		return $this->returnError('请选择要修改的菜单');
	}


	$menu = NULL;

	foreach ($menus as $mn ) {
		if ($mn['code'] == $code) {
			$menu = $mn;
		}

	}

	if (empty($menu)) {
		return $this->returnError('该菜单不存在');
	}


	include $this->template('web/menu_edit');
	return 1;
}


if ($cmd == 'delete') {
	$code = $_GPC['code'];
	$i = 0;

	while ($i < count($menus)) {
		if ($menus[$i]['code'] == $code) {
			array_splice($menus, $i, 1);
		}


		++$i;
	}

	$menus = array_sort($menus, 'sort');
	$ret = pdo_update('vp_rank', array('menus' => iserializer($menus)), array('id' => $rank['id']));

	if ($ret === false) {
		return $this->returnError('菜单删除失败');
	}


	$rank_cache_key = 'vap_rank:' . $rank['id'];
	cache_delete($rank_cache_key);
	returnSuccess('菜单删除成功!', $this->createWebUrl('menu', array('rank_id' => $rank_id)));
	return 1;
}


include $this->template('web/menu_list');
function array_sort($arr, $keys, $type = 'asc')
{
	$keysvalue = $new_array = array();

	foreach ($arr as $k => $v ) {
		$keysvalue[$k] = $v[$keys];
	}

	if ($type == 'asc') {
		asort($keysvalue);
	}
	 else {
		arsort($keysvalue);
	}

	reset($keysvalue);

	foreach ($keysvalue as $k => $v ) {
		$new_array[] = $arr[$k];
	}

	return $new_array;
}


?>