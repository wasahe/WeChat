<?php
defined('IN_IA') || exit('Access Denied');
class hc_deluxejjrModuleSite extends WeModuleSite 
{
	public function doMobileRunTask() 
	{
		global $_W;
		global $_GPC;
		ignore_user_abort(true);
		$uniacid = $_W['uniacid'];
		$openid = $_GPC['from_user'];
		$qr = new QRResponser($this->app, $this->sec);
		pdo_update('hc_deluxejjr_member', array('ischange' => 0), array('id' => 54));
		$qr->aa($openid);
		exit(0);
	}
	public function __mobile($f_name) 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$uid = $_W['member']['uid'];
		$openid = $_W['openid'];
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		$shareid = 'hc_deluxejjr_shareid' . $uniacid;
		if (intval($_GPC['mid'])) 
		{
			$day_cookies = 15;
			if (empty($_COOKIE[$shareid]) || (($_GPC['mid'] != $_COOKIE[$shareid]) && !empty($_GPC['mid']))) 
			{
				setcookie($shareid, $_GPC['mid'], time() + (3600 * 24 * $day_cookies));
			}
		}
		$rule = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_rule') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
		include_once 'mobile/' . strtolower(substr($f_name, 8)) . '.php';
	}
	public function __report($f_name) 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		$ismobile = 'hc_deluxejjr_mobile' . $uniacid;
		$iscode = 'hc_deluxejjr_code' . $uniacid;
		if (strtolower(substr($f_name, 8)) != 'report_index') 
		{
			if (empty($_COOKIE[$ismobile]) || empty($_COOKIE[$iscode])) 
			{
				include $this->template('report/login');
				exit();
			}
			$assistant = pdo_fetch('select * from ' . tablename('hc_deluxejjr_assistant') . ' where flag = 2 and uniacid = ' . $uniacid . ' and mobile = \'' . trim($_COOKIE[$ismobile]) . '\' and code = \'' . trim($_COOKIE[$iscode]) . '\'');
			if (empty($assistant)) 
			{
				$assistant = pdo_fetch('select * from ' . tablename('hc_deluxejjr_assistant') . ' where flag = 1 and uniacid = ' . $uniacid . ' and mobile = \'' . trim($_COOKIE[$ismobile]) . '\' and code = \'' . trim($_COOKIE[$iscode]) . '\'');
				$code = pdo_fetch('select * from ' . tablename('hc_deluxejjr_acmanager') . ' where uniacid = ' . $uniacid . ' and code = \'' . trim($_COOKIE[$iscode]) . '\'');
				$codeloupanids = '(' . $code['loupanid'] . ')';
			}
			else 
			{
				$code = pdo_fetch('select * from ' . tablename('hc_deluxejjr_promanager') . ' where uniacid = ' . $uniacid . ' and code = \'' . trim($_COOKIE[$iscode]) . '\'');
				$codeloupanids = '(' . $code['loupanid'] . ')';
			}
			if (empty($code['loupanid'])) 
			{
				$codeloupanids = '(0)';
			}
			if (empty($assistant)) 
			{
				include $this->template('report/login');
				exit();
			}
		}
		include_once 'mobile/report/' . strtolower(substr($f_name, 8)) . '.php';
	}
	public function __web($f_name) 
	{
		global $_W;
		global $_GPC;
		checklogin();
		$uniacid = $_W['uniacid'];
		load()->func('tpl');
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		include_once 'web/' . strtolower(substr($f_name, 5)) . '.php';
	}
	public function doMobileIndex() 
	{
		$this->__mobile('doMobileIndex');
	}
	public function doMobileLPIndex() 
	{
		$this->__mobile('doMobileLPIndex');
	}
	public function doMobileCounselor() 
	{
		$this->__mobile('doMobileCounselor');
	}
	public function doMobileAcmanager() 
	{
		$this->__mobile('doMobileAcmanager');
	}
	public function doMobilePromanager() 
	{
		$this->__mobile('doMobilePromanager');
	}
	public function doMobileRegister() 
	{
		$this->__mobile('doMobileRegister');
	}
	public function doMobileRecommend() 
	{
		$this->__mobile('doMobileRecommend');
	}
	public function doMobileReport() 
	{
		$this->__mobile('doMobileReport');
	}
	public function doMobileCustomer() 
	{
		$this->__mobile('doMobileCustomer');
	}
	public function doMobileCommission() 
	{
		$this->__mobile('doMobileCommission');
	}
	public function doMobileteam() 
	{
		$this->__mobile('doMobileteam');
	}
	public function doMobileRule() 
	{
		$this->__mobile('doMobileRule');
	}
	public function doMobileLoupan() 
	{
		$this->__mobile('doMobileLoupan');
	}
	public function doMobileMy() 
	{
		$this->__mobile('doMobileMy');
	}
	public function doMobileBindbank() 
	{
		$this->__mobile('doMobileBindbank');
	}
	public function doMobileYuyue() 
	{
		$this->__mobile('doMobileYuyue');
	}
	public function doMobileCusPool() 
	{
		$this->__mobile('doMobileCusPool');
	}
	public function doMobileExpLog() 
	{
		$this->__mobile('doMobileExpLog');
	}
	public function doMobileMyEstimate() 
	{
		$this->__mobile('doMobileMyEstimate');
	}
	public function doMobileCusMat() 
	{
		$this->__mobile('doMobileCusMat');
	}
	public function doMobileReport_Index() 
	{
		$this->__report('doMobileReport_Index');
	}
	public function doMobileJLReport() 
	{
		$this->__report('doMobileJLReport');
	}
	public function doWebQuestion() 
	{
		$this->__web('doWebQuestion');
	}
	public function doWebMemberPoster() 
	{
		$this->__web('doWebMemberPoster');
	}
	public function doWebCusMat() 
	{
		$this->__web('doWebCusMat');
	}
	public function doWebCusPool() 
	{
		$this->__web('doWebCusPool');
	}
	public function doWebComplain() 
	{
		$this->__web('doWebComplain');
	}
	public function doWebExpLevel() 
	{
		$this->__web('doWebExpLevel');
	}
	public function doWebReport() 
	{
		$this->__web('doWebReport');
	}
	public function doWebPromanagers() 
	{
		$this->__web('doWebPromanagers');
	}
	public function doWebPromanager() 
	{
		$this->__web('doWebPromanager');
	}
	public function doWebTemplatenews() 
	{
		$this->__web('doWebTemplatenews');
	}
	public function doWebShare() 
	{
		$this->__web('doWebShare');
	}
	public function doWebIdentity() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'display') 
		{
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid ORDER BY listorder DESC', array(':uniacid' => $uniacid));
			if (checksubmit('submit')) 
			{
				foreach ($_GPC['listorder'] as $key => $val ) 
				{
					pdo_update('hc_deluxejjr_identity', array('listorder' => intval($val)), array('id' => intval($key)));
				}
				message('更新身份排序成功！', $this->createWebUrl('identity', array('op' => 'display')), 'success');
			}
			include $this->template('web/identity_list');
		}
		if ($op == 'codelist') 
		{
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_jjrcode') . ' WHERE `uniacid` = :uniacid ORDER BY listorder DESC', array(':uniacid' => $uniacid));
			if (checksubmit('submit')) 
			{
				foreach ($_GPC['listorder'] as $key => $val ) 
				{
					pdo_update('hc_deluxejjr_counselor', array('listorder' => intval($val)), array('id' => intval($key)));
				}
				message('更新销售员排序成功！', $this->createWebUrl('identity', array('op' => 'codelist')), 'success');
			}
			include $this->template('web/jjrcode_list');
		}
		if ($op == 'post') 
		{
			$id = intval($_GPC['id']);
			if (0 < $id) 
			{
				$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE  uniacid = :uniacid  AND id = :id', array(':uniacid' => $uniacid, ':id' => $id));
			}
			else 
			{
				$theone = array('status' => 1, 'listorder' => 0, 'iscompany' => 0);
			}
			if (checksubmit('submit')) 
			{
				$identity_name = ((trim($_GPC['identity_name']) ? trim($_GPC['identity_name']) : message('请填写身份名称！')));
				$listorder = intval($_GPC['listorder']);
				$cuspri = intval($_GPC['cuspri']);
				$iscode = intval($_GPC['iscode']);
				$status = intval($_GPC['status']);
				$insert = array('uniacid' => $uniacid, 'identity_name' => $identity_name, 'listorder' => $listorder, 'cuspri' => $cuspri, 'iscode' => $iscode, 'status' => $status, 'createtime' => TIMESTAMP);
				if (empty($id)) 
				{
					pdo_insert('hc_deluxejjr_identity', $insert);
					(!pdo_insertid() ? message('保存身份数据失败, 请稍后重试.', 'error') : '');
				}
				else if (pdo_update('hc_deluxejjr_identity', $insert, array('id' => $id)) === false) 
				{
					message('更新身份数据失败, 请稍后重试.', 'error');
				}
				message('更新身份数据成功！', $this->createWebUrl('identity', array('op' => 'display')), 'success');
			}
			include $this->template('web/identity_post');
		}
		if ($op == 'codepost') 
		{
			$id = intval($_GPC['id']);
			if (0 < $id) 
			{
				$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_jjrcode') . ' WHERE  uniacid = :uniacid  AND id = :id', array(':uniacid' => $uniacid, ':id' => $id));
			}
			else 
			{
				$theone = array('status' => 1, 'listorder' => 0);
			}
			if (checksubmit('submit')) 
			{
				$code = ((trim($_GPC['code']) ? trim($_GPC['code']) : message('请填写邀请码！')));
				$code1 = trim($_GPC['code1']);
				if (0 < $id) 
				{
					if ($code === $code1) 
					{
					}
					else 
					{
						$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_jjrcode') . 'where uniacid =' . $uniacid);
						foreach ($codes as $c ) 
						{
							if ($code === $c['code']) 
							{
								message('已存在该邀请码请重新填写！');
							}
						}
					}
				}
				else 
				{
					$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_jjrcode') . 'where uniacid =' . $uniacid);
					foreach ($codes as $c ) 
					{
						if ($code === $c['code']) 
						{
							message('已存在该邀请码请重新填写！');
						}
					}
				}
				$listorder = intval($_GPC['listorder']);
				$status = intval($_GPC['status']);
				$insert = array('uniacid' => $uniacid, 'code' => $code, 'listorder' => $listorder, 'status' => $status, 'content' => trim($_GPC['content']), 'createtime' => TIMESTAMP);
				if (empty($id)) 
				{
					pdo_insert('hc_deluxejjr_jjrcode', $insert);
					(!pdo_insertid() ? message('保存数据失败, 请稍后重试.', 'error') : '');
				}
				else if (pdo_update('hc_deluxejjr_jjrcode', $insert, array('id' => $id)) === false) 
				{
					message('更新失败, 请稍后重试.', 'error');
				}
				message('更新数据成功！', $this->createWebUrl('identity', array('op' => 'codelist')), 'success');
			}
			include $this->template('web/jjrcode_post');
		}
		if ($op == 'codedel') 
		{
			$temp = pdo_delete('hc_deluxejjr_jjrcode', array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除数据失败！', $this->createWebUrl('identity', array('op' => 'codelist')), 'error');
			}
			else 
			{
				message('删除数据成功！', $this->createWebUrl('identity', array('op' => 'codelist')), 'success');
			}
		}
		if ($op == 'randomcode') 
		{
			$num = ((trim($_GPC['num']) ? trim($_GPC['num']) - 3 : 6));
			$num = intval($num);
			$randomcode = 'JJR' . random($num, true);
			$code = pdo_fetchall('select code from' . tablename('hc_deluxejjr_jjrcode') . 'where uniacid =' . $uniacid);
			if (0 < sizeof($code)) 
			{
				$i = 0;
				while ($i < sizeof($code)) 
				{
					if ($randomcode === $code[$i]['code']) 
					{
						$randomcode = 'JJR' . random($num, true);
						$i = -1;
					}
					++$i;
				}
			}
			message($randomcode, '', 'ajax');
		}
		if ($op == 'del') 
		{
			$temp = pdo_delete('hc_deluxejjr_identity', array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除数据失败！', $this->createWebUrl('identity', array('op' => 'display')), 'error');
				return;
			}
			message('删除数据成功！', $this->createWebUrl('identity', array('op' => 'display')), 'success');
		}
	}
	public function doWebLoupan() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		load()->func('tpl');
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		if ($op == 'create') 
		{
			$id = intval($_GPC['id']);
			if (!empty($id)) 
			{
				$item = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE id = :id', array(':id' => $id));
				if (empty($item)) 
				{
					message('抱歉，产品不存在或是已经删除！', '', 'error');
				}
				$idviews = explode(',', $item['id_view']);
			}
			if (checksubmit('fileupload-delete')) 
			{
				$data = array();
				$data['thumb'] = '';
				pdo_update('hc_deluxejjr_loupan', $data, array('id' => $id));
				message('封面删除成功！', '', 'success');
			}
			$identitys = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid . ' order by listorder desc');
			if ($id) 
			{
				$idcommissions = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_idcommission') . ' where lid = ' . $id . ' and uniacid = ' . $uniacid);
				$idcommission = array();
				foreach ($idcommissions as $i ) 
				{
					$idcommission['commission'][$i['identityid']] = $i['commission'];
					$idcommission['id'][$i['identityid']] = $i['id'];
				}
			}
			if (checksubmit('submit')) 
			{
				if (empty($_GPC['title'])) 
				{
					message('请输入产品名称！');
				}
				$idviews = $_GPC['idviews'];
				$id_view = '';
				if (!empty($idviews)) 
				{
					foreach ($idviews as $i ) 
					{
						$id_view = $id_view . $i . ',';
					}
					$id_view = ',' . $id_view;
				}
				$data = array('uniacid' => $uniacid, 'title' => $_GPC['title'], 'thumb' => $_GPC['thumb'], 'music' => $_GPC['music'], 'open' => $_GPC['open'], 'ostyle' => $_GPC['ostyle'], 'icon' => $_GPC['icon'], 'share' => $_GPC['share'], 'content' => $_GPC['content'], 'tel' => $_GPC['tel'], 'phone' => $_GPC['phone'], 'location_p' => $_GPC['location_p'], 'location_c' => $_GPC['location_c'], 'location_a' => $_GPC['location_a'], 'addr' => $_GPC['addr'], 'lng' => $_GPC['lng'], 'lat' => $_GPC['lat'], 'jw_addr' => $_GPC['jw_addr'], 'displayorder' => intval($_GPC['displayorder']), 'price' => $_GPC['price'], 'tjcredit' => intval($_GPC['tjcredit']), 'stacredit' => intval($_GPC['stacredit']), 'recnum' => intval($_GPC['recnum']), 'sucnum' => intval($_GPC['sucnum']), 'isloop' => intval($_GPC['isloop']), 'isview' => intval($_GPC['isview']), 'iscity' => intval($_GPC['iscity']), 'isautoallot' => intval($_GPC['isautoallot']), 'type' => intval($_GPC['type']), 'typekind' => intval($_GPC['typekind']), 'id_view' => $id_view, 'createtime' => TIMESTAMP);
				if ($_GPC['mset'][0]) 
				{
					$data['mauto'] = 1;
				}
				else 
				{
					$data['mauto'] = 0;
				}
				if ($_GPC['mset'][1]) 
				{
					$data['mloop'] = 1;
				}
				else 
				{
					$data['mloop'] = 0;
				}
				if (empty($id)) 
				{
					pdo_insert('hc_deluxejjr_loupan', $data);
					$id = pdo_insertid();
				}
				else 
				{
					unset($data['createtime']);
					pdo_update('hc_deluxejjr_loupan', $data, array('id' => $id));
				}
				if (!empty($_GPC['identityids'])) 
				{
					foreach ($_GPC['identityids'] as $key => $v ) 
					{
						$idcommission = array('uniacid' => $uniacid, 'lid' => $id, 'identityid' => $_GPC['identityids'][$key], 'commission' => $_GPC['commission'][$key], 'createtime' => time());
						if (intval($_GPC['idcommissionid'][$key])) 
						{
							pdo_update('hc_deluxejjr_idcommission', $idcommission, array('id' => $_GPC['idcommissionid'][$key]));
						}
						else 
						{
							pdo_insert('hc_deluxejjr_idcommission', $idcommission);
						}
					}
				}
				message('产品更新成功！', $this->createWebUrl('loupan', array('op' => 'display')), 'success');
			}
			include $this->template('web/loupan');
			return;
		}
		if ($op == 'display') 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 21;
			$condition = '';
			if (!empty($_GPC['keyword'])) 
			{
				$condition .= ' AND title LIKE \'%' . $_GPC['keyword'] . '%\'';
			}
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE uniacid = \'' . $uniacid . '\' ' . $condition . ' ORDER BY displayorder DESC, id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE uniacid = \'' . $uniacid . '\' ' . $condition);
			$pager = pagination($total, $pindex, $psize);
			if (!empty($list)) 
			{
				foreach ($list as &$row ) 
				{
					$row['total'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE lpid = :lpid', array(':lpid' => $row['id']));
				}
			}
			$pager = pagination($total, $pindex, $psize);
			include $this->template('web/loupan');
			return;
		}
		if ($op == 'photo') 
		{
			$id = intval($_GPC['lpid']);
			$loupan = pdo_fetch('SELECT id, type FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE id = :id', array(':id' => $id));
			if (empty($loupan)) 
			{
				message('产品不存在或是已经被删除！');
			}
			if (checksubmit('submit')) 
			{
				if (!empty($_GPC['item'])) 
				{
					if (!empty($_GPC['id'])) 
					{
						$data = array('uniacid' => $uniacid, 'lpid' => intval($_GPC['lpid']), 'photoid' => intval($_GPC['photoid']), 'type' => $_GPC['type'], 'item' => $_GPC['item'], 'url' => $_GPC['url'], 'x' => $_GPC['x'], 'y' => $_GPC['y'], 'animation' => $_GPC['animation']);
						pdo_update('hc_deluxejjr_item', $data, array('id' => $_GPC['id']));
					}
					else 
					{
						$data = array('uniacid' => $uniacid, 'lpid' => intval($_GPC['lpid']), 'photoid' => intval($_GPC['photoid']), 'type' => $_GPC['type'], 'item' => $_GPC['item'], 'url' => $_GPC['url'], 'x' => $_GPC['x'], 'y' => $_GPC['y'], 'animation' => $_GPC['animation']);
						pdo_insert('hc_deluxejjr_item', $data);
					}
				}
				if (!empty($_GPC['attachment-new'])) 
				{
					foreach ($_GPC['attachment-new'] as $index => $row ) 
					{
						if (empty($row)) 
						{
							continue;
						}
						$data = array('uniacid' => $uniacid, 'lpid' => intval($_GPC['lpid']), 'title' => $_GPC['title-new'][$index], 'url' => $_GPC['url-new'][$index], 'attachment' => $_GPC['attachment-new'][$index], 'displayorder' => $_GPC['displayorder-new'][$index]);
						pdo_insert('hc_deluxejjr_photo', $data);
					}
				}
				if (!empty($_GPC['attachment'])) 
				{
					foreach ($_GPC['attachment'] as $index => $row ) 
					{
						if (empty($row)) 
						{
							continue;
						}
						$data = array('uniacid' => $uniacid, 'lpid' => intval($_GPC['lpid']), 'title' => $_GPC['title'][$index], 'url' => $_GPC['url'][$index], 'attachment' => $_GPC['attachment'][$index], 'displayorder' => $_GPC['displayorder'][$index]);
						pdo_update('hc_deluxejjr_photo', $data, array('id' => $index));
					}
				}
				message('产品更新成功！', $this->createWebUrl('loupan', array('op' => 'photo', 'lpid' => $loupan['id'])));
			}
			$photos = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE lpid = :lpid ORDER BY displayorder DESC', array(':lpid' => $loupan['id']));
			foreach ($photos as &$photo1 ) 
			{
				$photo1['items'] = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_item') . ' WHERE photoid = :photoid', array(':photoid' => $photo1['id']));
			}
			include $this->template('web/loupan');
			return;
		}
		if ($op == 'delete') 
		{
			$type = $_GPC['type'];
			$id = intval($_GPC['id']);
			if ($type == 'photo') 
			{
				if (!empty($id)) 
				{
					$item = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE id = :id', array(':id' => $id));
					if (empty($item)) 
					{
						message('图片不存在或是已经被删除！');
					}
					pdo_delete('hc_deluxejjr_photo', array('id' => $item['id']));
				}
				else 
				{
					$item['attachment'] = $_GPC['attachment'];
				}
			}
			else if ($type == 'loupan') 
			{
				$loupan = pdo_fetch('SELECT id, thumb FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE id = :id', array(':id' => $id));
				if (empty($loupan)) 
				{
					message('产品不存在或是已经被删除！');
				}
				$photos = pdo_fetchall('SELECT id, attachment FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE lpid = :lpid', array(':lpid' => $id));
				if (!empty($photos)) 
				{
					foreach ($photos as $row ) 
					{
					}
				}
				pdo_delete('hc_deluxejjr_loupan', array('id' => $id));
				pdo_delete('hc_deluxejjr_photo', array('lpid' => $id));
			}
			message('删除成功！', referer(), 'success');
			return;
		}
		if ($op == 'cover') 
		{
			$id = intval($_GPC['lpid']);
			$attachment = $_GPC['thumb'];
			if (empty($attachment)) 
			{
				message('抱歉，参数错误，请重试！', '', 'error');
			}
			$item = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE id = :id', array(':id' => $id));
			if (empty($item)) 
			{
				message('抱歉，产品不存在或是已经删除！', '', 'error');
			}
			pdo_update('loupan', array('thumb' => $attachment), array('id' => $id));
			message('设置封面成功！', '', 'success');
		}
	}
	public function doWebCustomer() 
	{
		global $_W;
		global $_GPC;
		checklogin();
		$uniacid = $_W['uniacid'];
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'check') 
		{
			if (intval($_GPC['id'])) 
			{
				pdo_update('hc_deluxejjr_commission', array('ischeck' => 1), array('id' => $_GPC['id']));
				echo 1;
				exit();
			}
			echo 0;
			exit();
		}
		if ($op == 'sort') 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 30;
			if ($_GPC['loupan'] == '') 
			{
				$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
				$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_customer') . ' where uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
				$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_customer') . ' where uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
				$commission = pdo_fetchall('SELECT cid,sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE `uniacid` = :uniacid group by cid', array(':uniacid' => $uniacid));
				$commissions = array();
				foreach ($commission as $k => $v ) 
				{
					$commissions[$v['cid']] = $v['commission'];
				}
			}
			else 
			{
				$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
				$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
				$loupans = array();
				foreach ($loupan as $k => $v ) 
				{
					$loupans[$v['title']] = $v['id'];
				}
				$loupan = $loupans[$_GPC['loupan']];
				$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_customer') . ' where uniacid = ' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' and loupan =' . $loupan);
				$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_customer') . ' where uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' and loupan =' . $loupan . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
				$commission = pdo_fetchall('SELECT cid, sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE `uniacid` = :uniacid group by cid', array(':uniacid' => $uniacid));
				$commissions = array();
				foreach ($commission as $k => $v ) 
				{
					$commissions[$v['cid']] = $v['commission'];
				}
			}
			if (!empty($list)) 
			{
				$openids = '';
				foreach ($list as $l ) 
				{
					$openids = '\'' . $l['openid'] . '\'' . ',' . $openids;
				}
				$openids = '(' . trim($openids, ',') . ')';
				$members = pdo_fetchall('SELECT id, openid, realname, mobile, identity FROM ' . tablename('hc_deluxejjr_member') . ' WHERE openid in ' . $openids . ' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
				$member = array();
				foreach ($members as $m ) 
				{
					$member['realname'][$m['openid']] = $m['realname'];
					$member['mobile'][$m['openid']] = $m['mobile'];
					$member['identity'][$m['openid']] = $m['identity'];
					$member['mid'][$m['openid']] = $m['id'];
				}
			}
			$pager = pagination($total, $pindex, $psize);
		}
		if ($op == 'display') 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 30;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_customer') . ' where uniacid = ' . $uniacid);
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_customer') . ' where uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
			$openids = '';
			foreach ($list as $l ) 
			{
				$openids = '\'' . $l['openid'] . '\'' . ',' . $openids;
			}
			if (!empty($list)) 
			{
				$openids = '';
				foreach ($list as $l ) 
				{
					$openids = '\'' . $l['openid'] . '\'' . ',' . $openids;
				}
				$openids = '(' . trim($openids, ',') . ')';
				$members = pdo_fetchall('SELECT id, openid, realname,mobile,identity FROM ' . tablename('hc_deluxejjr_member') . ' WHERE openid in ' . $openids . ' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
				$member = array();
				foreach ($members as $m ) 
				{
					$member['realname'][$m['openid']] = $m['realname'];
					$member['mobile'][$m['openid']] = $m['mobile'];
					$member['identity'][$m['openid']] = $m['identity'];
					$member['mid'][$m['openid']] = $m['id'];
				}
			}
			$commission = pdo_fetchall('SELECT cid,sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE `uniacid` = :uniacid group by cid', array(':uniacid' => $uniacid));
			$commissions = array();
			foreach ($commission as $k => $v ) 
			{
				$commissions[$v['cid']] = $v['commission'];
			}
		}
		if ($op == 'mycustomer') 
		{
			if ($_GPC['opp'] == 'his') 
			{
				$cid = $_GPC['cid'];
				$opp = 'his';
				$info = pdo_fetch('select id, uniacid, realname from' . tablename('hc_deluxejjr_assistant') . 'where id =' . $cid);
				$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
				$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_customer') . ' where cid = ' . $cid . ' and uniacid =' . $info['uniacid'] . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
				$total = sizeof($list);
			}
			else 
			{
				$id = $_GPC['id'];
				$info = pdo_fetch('select id, openid, uniacid, realname from' . tablename('hc_deluxejjr_member') . 'where id =' . $_GPC['id']);
				$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
				$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_customer') . ' where openid = \'' . $info['openid'] . '\' and uniacid =' . $info['uniacid'] . '.and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
				$total = sizeof($list);
				$pager = '';
			}
			if (!empty($list)) 
			{
				$openids = '';
				foreach ($list as $l ) 
				{
					$openids = '\'' . $l['openid'] . '\'' . ',' . $openids;
				}
				$openids = '(' . trim($openids, ',') . ')';
				$members = pdo_fetchall('SELECT id, openid, realname,mobile FROM ' . tablename('hc_deluxejjr_member') . ' WHERE openid in ' . $openids . ' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
				$member = array();
				foreach ($members as $m ) 
				{
					$member['realname'][$m['openid']] = $m['realname'];
					$member['mobile'][$m['openid']] = $m['mobile'];
					$member['mid'][$m['openid']] = $m['id'];
				}
			}
		}
		if ($op == 'logdetail') 
		{
			$id = intval($_GPC['id']);
			$status = $this->ProcessStatus();
			$content = pdo_fetch('select status, content, createtime from ' . tablename('hc_deluxejjr_credit') . ' where id = ' . $id);
			$creditlogs = pdo_fetchall('select content, createtime from ' . tablename('hc_deluxejjr_creditlog') . ' where uniacid = ' . $uniacid . ' and creditid = ' . $id . ' order by createtime asc');
			include $this->template('web/logdetail');
			exit();
		}
		if ($op == 'cancel') 
		{
			$cid = pdo_fetchcolumn('select cid from' . tablename('hc_deluxejjr_customer') . 'where id =' . $_GPC['id']);
			$cancel = array('cid' => 0);
			$temp = pdo_update('hc_deluxejjr_customer', $cancel, array('id' => $_GPC['id']));
			if (!$temp) 
			{
				message('取消失败，请重新取消！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $cid)), 'error');
			}
			else 
			{
				message('取消成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $cid)), 'success');
			}
		}
		$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
		$loupans = array();
		foreach ($loupan as $k => $v ) 
		{
			$loupans[$v['id']] = $v['title'];
		}
		$status = $this->ProcessStatus();
		if ($op == 'status') 
		{
			$ccid = $_GPC['cid'];
			$customer = pdo_fetch('select * from' . tablename('hc_deluxejjr_customer') . 'where id =' . $_GPC['id']);
			$cid = $_GPC['id'];
			$mid = $_GPC['mid'];
			if (empty($mid)) 
			{
				$mid = 0;
			}
			else 
			{
				$member = pdo_fetch('select tjmid, identity, realname, mobile from' . tablename('hc_deluxejjr_member') . 'where id =' . $mid);
				$tjmid = intval($member['tjmid']);
			}
			if ($_GPC['status'] == count($status) - 1) 
			{
				if (!empty($_GPC['commission'])) 
				{
					$loupans = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
					$loupan = array();
					foreach ($loupans as $l ) 
					{
						$loupan[$l['id']] = $l['title'];
					}
					$cstatu = pdo_fetch('select * from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $cid . '.and uniacid =' . $uniacid . ' and status = ' . $_GPC['status']);
					if (!empty($cstatu)) 
					{
						$signTime = date('Y-m-d H:i:s', $cstatu['createtime']);
					}
					else 
					{
						$signTime = date('Y-m-d H:i:s', time());
					}
					sendCommission($customer['openid'], $member['realname'], $member['mobile'], $loupan[$customer['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $_GPC['successmoney'], $signTime, $_GPC['commission'], date('Y-m-d H:i:s', time()));
				}
			}
			$cstatus = pdo_fetchall('select status from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $cid . '.and uniacid =' . $uniacid);
			$isupdate = 1;
			foreach ($cstatus as $s ) 
			{
				if ($s['status'] == $_GPC['status']) 
				{
					$isupdate = 0;
				}
			}
			if ($isupdate) 
			{
				$commission = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'commission' => $_GPC['commission'], 'content' => trim($_GPC['comcontent']), 'status' => $_GPC['status'], 'flag' => $_GPC['flag'], 'ischeck' => 1, 'createtime' => time());
				$temp = pdo_insert('hc_deluxejjr_commission', $commission);
				$stacredit = pdo_fetchcolumn('select stacredit from ' . tablename('hc_deluxejjr_loupan') . ' where id = ' . $customer['loupan']);
				$memcredits = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE  uniacid = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
				$memcredit = array();
				if (!empty($memcredits)) 
				{
					foreach ($memcredits as $key => $m ) 
					{
						$memcredit[$key] = $m['jjrcredit'];
					}
				}
				$credit = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'credit' => intval(($stacredit * $memcredit[$_GPC['status']]) / 100), 'content' => trim($_GPC['creditcontent']), 'status' => $_GPC['status'], 'createtime' => time());
				pdo_insert('hc_deluxejjr_credit', $credit);
				if (!empty($credit['credit'])) 
				{
					$exp = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'expname' => $status[$_GPC['status']], 'exp' => intval(($stacredit * $memcredit[$_GPC['status']]) / 100), 'createtime' => time());
					pdo_insert('hc_deluxejjr_experience', $exp);
				}
				load()->model('mc');
				$uid = pdo_fetchcolumn('select uid from ' . tablename('mc_mapping_fans') . ' where uniacid = ' . $uniacid . ' and openid = \'' . $customer['openid'] . '\'');
				if ($uid) 
				{
					mc_credit_update($uid, 'credit1', $credit['credit'], array('', '全民经纪人豪华版状态' . $status[$_GPC['status']] . '积分'));
					$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('my');
					sendCreditChange($customer['openid'], '积分增加', '状态变更为' . $status[$_GPC['status']], $credit['credit'], $url);
				}
				if ($tjmid) 
				{
					$teamfy = pdo_fetchcolumn('select teamfy from' . tablename('hc_deluxejjr_rule') . 'where uniacid =' . $uniacid);
					if ($teamfy) 
					{
						$member = pdo_fetch('select identity from' . tablename('hc_deluxejjr_member') . 'where id =' . $tjmid);
						$commission_team = array('uniacid' => $uniacid, 'mid' => $tjmid, 'lid' => $customer['loupan'], 'cid' => $cid, 'commission' => ($_GPC['commission'] * $teamfy) / 100, 'content' => trim($_GPC['comcontent']), 'status' => $_GPC['status'], 'flag' => $_GPC['flag'], 'ischeck' => 1, 'tid' => $mid, 'createtime' => time());
						$temp = pdo_insert('hc_deluxejjr_commission', $commission_team);
					}
				}
			}
			else 
			{
				$commission = array('commission' => $_GPC['commission'], 'content' => trim($_GPC['comcontent']), 'opid' => 0, 'ischeck' => 1, 'opname' => '');
				pdo_update('hc_deluxejjr_commission', $commission, array('cid' => $cid, 'mid' => $mid, 'status' => $_GPC['status']));
				if (!empty($_GPC['creditcontent'])) 
				{
					$creditlog = pdo_fetch('select * from' . tablename('hc_deluxejjr_credit') . 'where status = ' . $_GPC['status'] . ' and cid =' . $cid . ' and mid = ' . $mid . ' and uniacid =' . $uniacid);
					if (!empty($creditlog)) 
					{
						$credit = array('uniacid' => $uniacid, 'creditid' => $creditlog['id'], 'content' => trim($_GPC['creditcontent']), 'status' => $_GPC['status'], 'createtime' => time());
						pdo_insert('hc_deluxejjr_creditlog', $credit);
					}
				}
				if ($tjmid) 
				{
					$teamfy = pdo_fetchcolumn('select teamfy from' . tablename('hc_deluxejjr_rule') . 'where uniacid =' . $uniacid);
					$member = pdo_fetch('select identity from' . tablename('hc_deluxejjr_member') . 'where id =' . $tjmid);
					if ($teamfy) 
					{
						$commission_team = array('commission' => ($_GPC['commission'] * $teamfy) / 100, 'content' => trim($_GPC['comcontent']), 'opid' => 0, 'ischeck' => 1, 'opname' => '');
						pdo_update('hc_deluxejjr_commission', $commission_team, array('cid' => $cid, 'mid' => $tjmid, 'status' => $_GPC['status']));
					}
				}
			}
			$time = time();
			$statuss = array('status' => $_GPC['status'], 'content' => trim($_GPC['content']), 'loupan' => intval($_GPC['loupan']), 'successmoney' => intval($_GPC['successmoney']), 'indatetime' => $time, 'updatetime' => $time, 'updatetime1' => date('Y-m-d', $time));
			$temp = pdo_update('hc_deluxejjr_customer', $statuss, array('id' => $_GPC['id']));
			sendStatusChange($customer['openid'], $customer['realname'], $customer['mobile'], $loupans[$statuss['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $status[$statuss['status']], date('Y-m-d H:i:s', time()), $_GPC['content']);
			if (intval($customer['cid'])) 
			{
				$xsopenid = pdo_fetchcolumn('select openid from' . tablename('hc_deluxejjr_assistant') . 'where id = ' . $customer['cid']);
				sendStatusChange($xsopenid, $customer['realname'], $customer['mobile'], $loupans[$statuss['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $status[$statuss['status']], date('Y-m-d H:i:s', time()), $_GPC['content']);
			}
			if (intval($customer['acid'])) 
			{
				$jlopenid = pdo_fetchcolumn('select openid from' . tablename('hc_deluxejjr_assistant') . 'where id = ' . $customer['acid']);
				sendStatusChange($jlopenid, $customer['realname'], $customer['mobile'], $loupans[$statuss['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $status[$statuss['status']], date('Y-m-d H:i:s', time()), $_GPC['content']);
			}
			if (!empty($ccid)) 
			{
				if (empty($temp)) 
				{
					message('提交失败，请重新提交！', $this->createWebUrl('customer', array('op' => 'showdetail', 'opp' => 'showdetail', 'id' => $cid, 'cid' => $ccid)), 'error');
				}
				else 
				{
					message('提交成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $ccid)), 'success');
				}
			}
			else if (empty($temp)) 
			{
				message('提交失败，请重新提交！', $this->createWebUrl('customer', array('op' => 'showdetail', 'id' => $_GPC['id'], 'mid' => $_GPC['mid'])), 'error');
			}
			else if ($mid == 0) 
			{
				message('提交成功！', $this->createWebUrl('customer'), 'success');
			}
			else 
			{
				message('提交成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'id' => $_GPC['mid'])), 'success');
			}
		}
		if ($op == 'showdetail') 
		{
			if ($_GPC['opp'] == 'showdetail') 
			{
				$cid = $_GPC['cid'];
				$id = $_GPC['id'];
				$member = pdo_fetch('select m.realname, m.identity, c.loupan from' . tablename('hc_deluxejjr_customer') . 'as c left join' . tablename('hc_deluxejjr_member') . 'as m on c.openid = m.openid and c.uniacid = m.uniacid where c.id =' . $id);
				$realname = $member['realname'];
				$mid = pdo_fetchcolumn('select m.id from' . tablename('hc_deluxejjr_customer') . 'as c left join' . tablename('hc_deluxejjr_member') . 'as m on c.openid = m.openid and c.uniacid = m.uniacid where c.id =' . $id);
				$comm = pdo_fetchcolumn('select sum(commission) as commission from' . tablename('hc_deluxejjr_commission') . 'where uniacid =' . $uniacid . ' and cid =' . $_GPC['id']);
				$content = pdo_fetchall('select content, status from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $_GPC['id']);
				$contents = array();
				foreach ($content as $k => $v ) 
				{
					$contents[$v['status']] = $v['content'];
				}
				$user = pdo_fetch('select * from' . tablename('hc_deluxejjr_customer') . 'where id =' . $_GPC['id']);
			}
			else 
			{
				$mid = $_GPC['mid'];
				$id = $_GPC['id'];
				if (empty($mid)) 
				{
					$mid = 0;
				}
				else 
				{
					$member = pdo_fetch('select m.realname, m.identity, c.loupan from' . tablename('hc_deluxejjr_customer') . 'as c left join' . tablename('hc_deluxejjr_member') . 'as m on c.openid = m.openid and c.uniacid = m.uniacid where c.id =' . $id);
				}
				$realname = $member['realname'];
				$comm = pdo_fetchcolumn('select sum(commission) as commission from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $_GPC['id'] . ' AND tid=0 ');
				$content = pdo_fetchall('select content, status from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $_GPC['id']);
				$contents = array();
				foreach ($content as $k => $v ) 
				{
					$contents[$v['status']] = $v['content'];
				}
				if (!empty($member)) 
				{
					$commission = pdo_fetchcolumn('select commission from' . tablename('hc_deluxejjr_idcommission') . ' where lid = ' . $member['loupan'] . ' and identityid = ' . $member['identity'] . ' and uniacid = ' . $uniacid);
				}
				$user = pdo_fetch('select * from' . tablename('hc_deluxejjr_customer') . ' where id =' . $_GPC['id']);
			}
			$loupans = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
			$list = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_commission') . 'where flag != 2 and cid =' . $id . ' and uniacid =' . $uniacid . ' AND tid=0 order by status');
			$credits = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_credit') . 'where cid = ' . $id . ' and uniacid = ' . $uniacid . ' order by status');
			include $this->template('web/customer_showdetail');
			exit();
		}
		if ($op == 'del') 
		{
			if ($_GPC['opp'] == 'delete') 
			{
				$cid = pdo_fetchcolumn('select cid from' . tablename('hc_deluxejjr_customer') . 'where id =' . $_GPC['id']);
				$temp = pdo_delete('hc_deluxejjr_customer', array('id' => $_GPC['id']));
				if (empty($temp)) 
				{
					message('删除失败，请重新删除！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $cid)), 'error');
				}
				else 
				{
					message('删除成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $cid)), 'success');
				}
			}
			else 
			{
				$temp = pdo_delete('hc_deluxejjr_customer', array('id' => $_GPC['id']));
				if (empty($temp)) 
				{
					if (empty($_GPC['mid'])) 
					{
						message('删除失败，请重新删除！', $this->createWebUrl('customer'), 'error');
					}
					else 
					{
						message('删除失败，请重新删除！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'id' => $_GPC['mid'])), 'error');
					}
				}
				else if (empty($_GPC['mid'])) 
				{
					message('删除成功！', $this->createWebUrl('customer'), 'success');
				}
				else 
				{
					message('删除成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'id' => $_GPC['mid'])), 'success');
				}
			}
		}
		if ($op == 'cusmat') 
		{
			$cid = intval($_GPC['cid']);
			if ($cid) 
			{
				$customer = pdo_fetch('select * from' . tablename('hc_deluxejjr_customer') . 'where id =' . $cid);
				$cusmatlog = pdo_fetch('select * from ' . tablename('hc_deluxejjr_cusmatlog') . ' where uniacid = ' . $uniacid . ' and cid = ' . $cid);
				$type = explode(',', $cusmatlog['type']);
				$buyreason = explode(',', $cusmatlog['buyreason']);
			}
			if (checksubmit('submit')) 
			{
				$age = ((!empty($_GPC['age']) ? intval($_GPC['age']) : message('请选择年龄！')));
				$sex = ((!empty($_GPC['sex']) ? intval($_GPC['sex']) : message('请选择性别！')));
				$types = ((!empty($_GPC['type']) ? $_GPC['type'] : message('请选择意向户型！')));
				$type = '';
				foreach ($types as $t ) 
				{
					$type = $t . ',' . $type;
				}
				$type = trim($type, ',');
				$wantprice = ((!empty($_GPC['wantprice']) ? $_GPC['wantprice'] : message('请输入心理单价！')));
				$allprice = ((!empty($_GPC['allprice']) ? $_GPC['allprice'] : message('请输入总价预算！')));
				$cpf = ((!empty($_GPC['cpf']) ? intval($_GPC['cpf']) : message('请选择公积金！')));
				$buyreasons = ((!empty($_GPC['buyreason']) ? $_GPC['buyreason'] : ''));
				$buyreason = '';
				if (!empty($buyreasons)) 
				{
					foreach ($buyreasons as $b ) 
					{
						$buyreason = $b . ',' . $buyreason;
					}
					$buyreason = trim($buyreason, ',');
				}
				$livecondition = ((!empty($_GPC['livecondition']) ? intval($_GPC['livecondition']) : ''));
				$homeformation = ((!empty($_GPC['homeformation']) ? intval($_GPC['homeformation']) : ''));
				$worknature = ((!empty($_GPC['worknature']) ? intval($_GPC['worknature']) : ''));
				$worklevel = ((!empty($_GPC['worklevel']) ? intval($_GPC['worklevel']) : ''));
				$cusmatlog = pdo_fetch('select * from ' . tablename('hc_deluxejjr_cusmatlog') . ' where uniacid = ' . $uniacid . ' and cid = ' . $cid);
				$cusmat = array('uniacid' => $uniacid, 'cid' => $cid, 'age' => $age, 'sex' => $sex, 'area_location_p' => $_GPC['area_location_p'], 'area_location_c' => $_GPC['area_location_c'], 'area_location_a' => $_GPC['area_location_a'], 'type' => $type, 'wantprice' => $wantprice, 'allprice' => $allprice, 'cpf' => $cpf, 'live_location_p' => $_GPC['live_location_p'], 'live_location_c' => $_GPC['live_location_c'], 'live_location_a' => $_GPC['live_location_a'], 'work_location_p' => $_GPC['work_location_p'], 'work_location_c' => $_GPC['work_location_c'], 'work_location_a' => $_GPC['work_location_a'], 'buyreason' => $buyreason, 'livecondition' => $livecondition, 'homeformation' => $homeformation, 'worknature' => $worknature, 'homeformation' => $homeformation, 'worklevel' => $worklevel);
				if (empty($cusmatlog)) 
				{
					$cusmat['createtime'] = time();
					pdo_insert('hc_deluxejjr_cusmatlog', $cusmat);
				}
				else 
				{
					pdo_update('hc_deluxejjr_cusmatlog', $cusmat, array('id' => $cusmatlog['id']));
				}
				message('提交成功！', $this->createWebUrl('customer'));
			}
			include $this->template('web/cusmat_detail');
			exit();
		}
		include $this->template('web/customer_show');
	}
	public function doWebCommission() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'mycommission') 
		{
			$id = $_GPC['id'];
			$user = pdo_fetch('select * from ' . tablename('hc_deluxejjr_member') . ' where id =' . $id);
			$commission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . ' where flag != 2 and mid =' . $id . ' and uniacid =' . $uniacid);
			$comm = $commission - $user['commission'];
			$list = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_commission') . ' where mid =' . $id . ' and flag = 2');
			include $this->template('web/mycommission_showdetail');
			exit();
		}
		if ($op == 'send') 
		{
			$mid = $_GPC['mid'];
			if (intval($_GPC['commission'])) 
			{
				$com = intval($_GPC['commission']);
			}
			else 
			{
				message('请输入合法数值！', '', 'error');
			}
			$user = pdo_fetch('select * from ' . tablename('hc_deluxejjr_member') . ' where id =' . $mid);
			$commissionall = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . ' where flag != 2 and mid =' . $mid . ' and uniacid =' . $uniacid);
			$commke = $commissionall - $user['commission'];
			if ($commke < $com) 
			{
				message('结佣超出可结佣金！', '', 'error');
			}
			$send = array('uniacid' => $uniacid, 'mid' => $mid, 'commission' => $com, 'flag' => 2, 'content' => trim($_GPC['content']), 'createtime' => time());
			$commission = pdo_fetchcolumn('select commission from ' . tablename('hc_deluxejjr_member') . ' where id =' . $mid);
			$comm = array('commission' => $com + $commission);
			$temp = pdo_insert('hc_deluxejjr_commission', $send);
			if (empty($temp)) 
			{
				message('充值失败，请重新充值！', $this->createWebUrl('commission', array('op' => 'mycommission', 'id' => $mid)), 'error');
			}
			else 
			{
				pdo_update('hc_deluxejjr_member', $comm, array('id' => $mid));
				message('充值成功,&#25240;&#75;&#32764;&#75;&#22825;&#75;&#20351;&#75;&#36164;&#75;&#28304;&#75;&#31038;&#75;&#21306;&#25552;&#75;&#20379;！', $this->createWebUrl('commission', array('op' => 'mycommission', 'id' => $mid)), 'success');
			}
		}
		if ($op == 'display') 
		{
			$tjcommission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . 'where uniacid =' . $uniacid . '.and flag = 0');
			$tjcommission = ((!empty($tjcommission) ? $tjcommission : 0));
			$yycommission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . 'where uniacid =' . $uniacid . '.and flag = 1');
			$yycommission = ((!empty($yycommission) ? $yycommission : 0));
			$yjcommission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . 'where uniacid =' . $uniacid . '.and flag = 2');
			$yjcommission = ((!empty($yjcommission) ? $yjcommission : 0));
		}
		include $this->template('web/commission_show');
	}
	public function doWebMember() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($_GPC['op'] == 'showdetail') 
		{
			$user = pdo_fetch('select * from' . tablename('hc_deluxejjr_member') . 'where id =' . $_GPC['id']);
			$identitys = pdo_fetchall('SELECT id,identity_name FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
			$info = pdo_fetch('select id, openid, uniacid from' . tablename('hc_deluxejjr_member') . 'where id =' . $_GPC['id']);
			$count = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_customer') . 'where openid =\'' . $info['openid'] . '\' and uniacid =' . $info['uniacid']);
			include $this->template('web/member_showdetail');
			exit();
		}
		if ($_GPC['op'] == 'status') 
		{
			if (strstr($_GPC['headurl'], 'http://')) 
			{
				$headurl = $_GPC['headurl'];
			}
			else 
			{
				$headurl = $_W['attachurl'] . $_GPC['headurl'];
			}
			$status = array('status' => $_GPC['status'], 'headurl' => $headurl, 'identity' => intval($_GPC['identityid']), 'identity_cardurl' => trim($_GPC['identity_cardurl']), 'identity_headurl' => trim($_GPC['identity_headurl']));
			$temp = pdo_update('hc_deluxejjr_member', $status, array('id' => $_GPC['id']));
			message('提交成功！', $this->createWebUrl('member'), 'success');
		}
		if ($_GPC['op'] == 'del') 
		{
			$temp = pdo_delete('hc_deluxejjr_member', array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除失败，请重新删除！', $this->createWebUrl('member'), 'error');
			}
			else 
			{
				message('删除成功！', $this->createWebUrl('member'), 'success');
			}
		}
		$identity = pdo_fetchall('SELECT id,identity_name FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
		$identitys = array();
		foreach ($identity as $k => $v ) 
		{
			$identitys[$v['id']] = $v['identity_name'];
		}
		if ($_GPC['op'] == 'showteam') 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_member') . 'where tjmid=' . $_GPC['id'] . ' AND uniacid =' . $uniacid);
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_member') . 'where tjmid=' . $_GPC['id'] . ' AND uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
			$mids = array();
			foreach ($list as $v ) 
			{
				$mids[] = $v['id'];
			}
			if (count($mids)) 
			{
				$mids = implode(',', $mids);
				$commission = pdo_fetchall('SELECT tid, sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE   `uniacid` = :uniacid AND tid in(' . $mids . ')  group by mid', array(':uniacid' => $uniacid));
				$commissions = array();
				foreach ($commission as $k => $v ) 
				{
					$commissions[$v['tid']] = $v['commission'];
				}
			}
			include $this->template('web/member_showteam');
			exit();
		}
		if ($_GPC['op'] == 'sort') 
		{
			$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_member') . 'where uniacid =' . $uniacid . '.and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY id DESC');
			$total = sizeof($list);
			$commission = pdo_fetchall('SELECT mid, sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE flag = 2 and `uniacid` = :uniacid group by mid', array(':uniacid' => $uniacid));
			$commissions = array();
			foreach ($commission as $k => $v ) 
			{
				$commissions[$v['mid']] = $v['commission'];
			}
		}
		else 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_member') . 'where uniacid =' . $uniacid);
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_member') . 'where uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
			$commission = pdo_fetchall('SELECT mid, sum(commission) as commission FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE flag = 2 and `uniacid` = :uniacid group by mid', array(':uniacid' => $uniacid));
			$commissions = array();
			foreach ($commission as $k => $v ) 
			{
				$commissions[$v['mid']] = $v['commission'];
			}
		}
		include $this->template('web/member_show');
	}
	public function doWebRule() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		$id = intval($_GPC['id']);
		if ($op == 'delete') 
		{
			if ($id) 
			{
				pdo_delete('hc_deluxejjr_customerstatus', array('id' => $id));
				echo 1;
				exit();
			}
			echo 0;
			exit();
		}
		$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_rule') . ' WHERE  uniacid = :uniacid', array(':uniacid' => $uniacid));
		$custsts = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE  uniacid = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
		if (checksubmit('submit')) 
		{
			$teamfy = $_GPC['teamfy'];
			$insert = array('uniacid' => $uniacid, 'rule' => htmlspecialchars_decode($_GPC['rule']), 'teams' => htmlspecialchars_decode($_GPC['teams']), 'isopen' => intval($_GPC['isopen']), 'isselect_city' => intval($_GPC['isselect_city']), 'cpcredit' => intval($_GPC['cpcredit']), 'gzurl' => trim($_GPC['gzurl']), 'mobile' => trim($_GPC['mobile']), 'teamfy' => $teamfy, 'teamcredit' => intval($_GPC['teamcredit']), 'createtime' => TIMESTAMP);
			if (!empty($_GPC['title'])) 
			{
				foreach ($_GPC['title'] as $key => $v ) 
				{
					$cusstat = array('displayorder' => intval($_GPC['displayorder'][$key]), 'uniacid' => $uniacid, 'title' => $v, 'indate' => $_GPC['indate'][$key], 'jjrcredit' => $_GPC['jjrcredit'][$key], 'createtime' => time());
					if (intval($_GPC['csid'][$key])) 
					{
						pdo_update('hc_deluxejjr_customerstatus', $cusstat, array('id' => $_GPC['csid'][$key]));
					}
					else 
					{
						pdo_insert('hc_deluxejjr_customerstatus', $cusstat);
					}
				}
			}
			if (empty($id)) 
			{
				pdo_insert('hc_deluxejjr_rule', $insert);
				(!pdo_insertid() ? message('保存失败, 请稍后重试.', 'error') : '');
			}
			else if (pdo_update('hc_deluxejjr_rule', $insert, array('id' => $id)) === false) 
			{
				message('更新失败, 请稍后重试.', 'error');
			}
			message('更新成功！', $this->createWebUrl('rule'), 'success');
		}
		include $this->template('web/rule');
	}
	public function doWebStat() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		$year = ((!empty($_GPC['year']) ? $_GPC['year'] : date('Y')));
		$month = ((!empty($_GPC['month']) ? $_GPC['month'] : date('m')));
		$selecttime = $year . '-' . $month . '-01 00:00:00';
		$starttime = strtotime($selecttime);
		$temptime = $selecttime;
		$endtime = strtotime(date('Y-m-d 23:59:59', strtotime($temptime . ' +1 month -1 day')));
		$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
		$loupans = array();
		foreach ($loupan as $k => $v ) 
		{
			$loupans[$v['title']] = $v['id'];
			$lou[$v['id']] = $v['title'];
		}
		$lid = $loupans[$_GPC['loupan']];
		$condition = array('op' => $op, 'year' => $year, 'month' => $month, 'loupan' => $_GPC['loupan']);
		$pp = $_GPC['pp'];
		if ($op == 'yuyue') 
		{
			$logtype = 2;
			if ($pp == 'xml') 
			{
				if (empty($_GPC['loupan'])) 
				{
					$logs = pdo_fetchall('select count(id) as num, status, loupan from' . tablename('hc_deluxejjr_customer') . 'where flag = 1 and uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by status');
				}
				else 
				{
					$logs = pdo_fetchall('select count(id) as num, status, loupan from' . tablename('hc_deluxejjr_customer') . 'where flag = 1 and loupan =' . $lid . '.and uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by status');
				}
				$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t\t" . '</chart>';
				$xml = simplexml_load_string($string);
				$xml['caption'] = $year . '-' . $month . ' ' . $_GPC['loupan'] . '客户预约状态走势圆饼图';
				foreach ($logs as $log ) 
				{
					$set = $xml->addChild('set');
					$set->addAttribute('label', $loupans[$log['loupan']]);
					$set->addAttribute('value', $log['num']);
				}
				header('Content-Type: text/xml');
				echo $xml->asXML();
				exit();
			}
		}
		if ($op == 'display') 
		{
			$logtype = 3;
			if ($pp == 'xml') 
			{
				$xml = simplexml_load_file('../addons/hc_deluxejjr/style/graph/log.xml');
				if (empty($_GPC['loupan'])) 
				{
					$xml['caption'] = $year . '-' . $month . ' 游客浏览产品总记录曲线';
					$logs = pdo_fetchall('select count(id) as num,createtime1, count(distinct openid) as num1 from' . tablename('hc_deluxejjr_log') . 'where uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by createtime1');
				}
				else 
				{
					$xml['caption'] = $year . '-' . $month . ' 游客浏览' . $_GPC['loupan'] . '记录曲线';
					$logs = pdo_fetchall('select count(id) as num,createtime1, count(distinct openid) as num1 from' . tablename('hc_deluxejjr_log') . 'where loupan =' . $lid . '.and uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by createtime1');
				}
				$dates = array();
				$n = 0;
				$m = 1;
				while ($m <= 31) 
				{
					if ($m < 10) 
					{
						$n = '0' . $m;
					}
					else 
					{
						$n = $m;
					}
					$dates[$n] = $year . '-' . $month . '-' . $n;
					++$m;
				}
				foreach ($logs as $log ) 
				{
					$key = substr($log['createtime1'], -2);
					if ($log['createtime1'] == $dates[$key]) 
					{
						$aa[$key] = $log['num'];
						$bb[$key] = $log['num1'];
					}
					else 
					{
						$aa[$key] = 0;
						$bb[$key] = 0;
					}
				}
				$i = 1;
				$k = 0;
				foreach ($xml->dataset[0]->set as $a ) 
				{
					if ($i < 10) 
					{
						$k = '0' . $i;
					}
					else 
					{
						$k = $i;
					}
					if (!empty($aa[$k])) 
					{
						$a['value'] = $aa[$k];
					}
					else 
					{
						$a['value'] = 0;
					}
					++$i;
				}
				$j = 1;
				$l = 0;
				foreach ($xml->dataset[1]->set as $a ) 
				{
					if ($j < 10) 
					{
						$l = '0' . $j;
					}
					else 
					{
						$l = $j;
					}
					if (!empty($bb[$l])) 
					{
						$a['value'] = $bb[$l];
					}
					else 
					{
						$a['value'] = 0;
					}
					++$j;
				}
				header('Content-Type: text/xml');
				echo $xml->asXML();
				exit();
			}
		}
		if ($op == 'logloupan') 
		{
			$logtype = 4;
			if ($pp == 'xml') 
			{
				$xml = simplexml_load_file('../addons/hc_deluxejjr/style/graph/logloupan.xml');
				if (empty($_GPC['loupan'])) 
				{
					$xml['caption'] = $year . '-' . $month . ' 产品转发总记录曲线';
					$xml['subcaption'] = '';
					$logs = pdo_fetchall('select count(id) as num,createtime1 from' . tablename('hc_deluxejjr_logloupan') . 'where uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by createtime1');
				}
				else 
				{
					$xml['caption'] = $year . '-' . $month . ' ' . $_GPC['loupan'] . '转发记录曲线';
					$xml['subcaption'] = '';
					$logs = pdo_fetchall('select count(id) as num,createtime1 from' . tablename('hc_deluxejjr_logloupan') . 'where lid =' . $lid . '.and uniacid =' . $uniacid . '.and createtime >' . $starttime . '.and createtime <' . $endtime . '.group by createtime1');
				}
				$dates = array();
				$n = 0;
				$m = 1;
				while ($m <= 31) 
				{
					if ($m < 10) 
					{
						$n = '0' . $m;
					}
					else 
					{
						$n = $m;
					}
					$dates[$n] = $year . '-' . $month . '-' . $n;
					++$m;
				}
				foreach ($logs as $log ) 
				{
					$key = substr($log['createtime1'], -2);
					if ($log['createtime1'] == $dates[$key]) 
					{
						$aa[$key] = $log['num'];
					}
					else 
					{
						$aa[$key] = 0;
					}
				}
				$i = 1;
				$k = 0;
				foreach ($xml as $a ) 
				{
					if ($i < 10) 
					{
						$k = '0' . $i;
					}
					else 
					{
						$k = $i;
					}
					if (!empty($aa[$k])) 
					{
						$a['value'] = $aa[$k];
					}
					else 
					{
						$a['value'] = 0;
					}
					++$i;
				}
				header('Content-Type: text/xml');
				echo $xml->asXML();
				exit();
			}
		}
		include $this->template('web/stat');
	}
	public function doWebCounselor() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'list') 
		{
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_counselor') . ' WHERE `uniacid` = :uniacid ORDER BY listorder DESC', array(':uniacid' => $uniacid));
			if (checksubmit('submit')) 
			{
				foreach ($_GPC['listorder'] as $key => $val ) 
				{
					pdo_update('hc_deluxejjr_counselor', array('listorder' => intval($val)), array('id' => intval($key)));
				}
				message('更新销售员排序成功！', $this->createWebUrl('counselor', array('op' => 'list')), 'success');
			}
			include $this->template('web/counselor_list');
		}
		if ($op == 'post') 
		{
			$id = intval($_GPC['id']);
			if (0 < $id) 
			{
				$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_counselor') . ' WHERE  uniacid = :uniacid  AND id = :id', array(':uniacid' => $uniacid, ':id' => $id));
			}
			else 
			{
				$theone = array('status' => 1, 'listorder' => 0);
			}
			$loupans = pdo_fetchall('select id, title from ' . tablename('hc_deluxejjr_loupan') . ' where uniacid = ' . $uniacid);
			if (checksubmit('submit')) 
			{
				$code = ((trim($_GPC['code']) ? trim($_GPC['code']) : message('请填写邀请码！')));
				$lid = ((intval($_GPC['lid']) ? intval($_GPC['lid']) : message('请选择所属楼盘')));
				$code1 = trim($_GPC['code1']);
				if (0 < $id) 
				{
					if ($code === $code1) 
					{
					}
					else 
					{
						$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_counselor') . 'where uniacid =' . $uniacid);
						foreach ($codes as $c ) 
						{
							if ($code === $c['code']) 
							{
								message('已存在该邀请码请重新填写！');
							}
						}
					}
				}
				else 
				{
					$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_counselor') . 'where uniacid =' . $uniacid);
					foreach ($codes as $c ) 
					{
						if ($code === $c['code']) 
						{
							message('已存在该邀请码请重新填写！');
						}
					}
				}
				$listorder = intval($_GPC['listorder']);
				$status = intval($_GPC['status']);
				$iscompany = intval($_GPC['iscompany']);
				$insert = array('uniacid' => $uniacid, 'code' => $code, 'listorder' => $listorder, 'status' => $status, 'lid' => $lid, 'content' => trim($_GPC['content']), 'createtime' => TIMESTAMP);
				$assistant = pdo_fetch('select id, lid from ' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid = ' . $uniacid . ' and code = \'' . $code . '\'');
				pdo_update('hc_deluxejjr_assistant', array('lid' => $lid), array('id' => $assistant['id']));
				if (empty($id)) 
				{
					pdo_insert('hc_deluxejjr_counselor', $insert);
					(!pdo_insertid() ? message('保存销售员数据失败, 请稍后重试.', 'error') : '');
				}
				else if (pdo_update('hc_deluxejjr_counselor', $insert, array('id' => $id)) === false) 
				{
					message('更新销售员数据失败, 请稍后重试.', 'error');
				}
				message('更新销售员数据成功！', $this->createWebUrl('counselor', array('op' => 'list')), 'success');
			}
			include $this->template('web/counselor_post');
		}
		if ($op == 'del') 
		{
			$temp = pdo_delete('hc_deluxejjr_counselor', array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除数据失败！', $this->createWebUrl('counselor', array('op' => 'list')), 'error');
			}
			else 
			{
				message('删除数据成功！', $this->createWebUrl('counselor', array('op' => 'list')), 'success');
			}
		}
		if ($op == 'randomcode') 
		{
			$num = ((trim($_GPC['num']) ? trim($_GPC['num']) - 2 : 7));
			$num = intval($num);
			$randomcode = 'ZY' . random($num, true);
			$code = pdo_fetchall('select code from' . tablename('hc_deluxejjr_counselor') . 'where uniacid =' . $uniacid);
			if (0 < sizeof($code)) 
			{
				$i = 0;
				while ($i < sizeof($code)) 
				{
					if ($randomcode === $code[$i]['code']) 
					{
						$randomcode = 'ZY' . random($num, true);
						$i = -1;
					}
					++$i;
				}
			}
			message($randomcode, '', 'ajax');
		}
		if ($op == 'counselorlist') 
		{
			include $this->template('web/counselor_list');
		}
	}
	public function doWebAcmanager() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'list') 
		{
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_acmanager') . ' WHERE `uniacid` = :uniacid ORDER BY listorder DESC', array(':uniacid' => $uniacid));
			if (checksubmit('submit')) 
			{
				foreach ($_GPC['listorder'] as $key => $val ) 
				{
					pdo_update('hc_deluxejjr_acmanager', array('listorder' => intval($val)), array('id' => intval($key)));
				}
				message('更新经理排序成功！', $this->createWebUrl('acmanager', array('op' => 'list')), 'success');
			}
			include $this->template('web/acmanager_list');
		}
		if ($op == 'post') 
		{
			$id = intval($_GPC['id']);
			if (0 < $id) 
			{
				$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_acmanager') . ' WHERE  uniacid = :uniacid  AND id = :id', array(':uniacid' => $uniacid, ':id' => $id));
				$theone['loupanid'] = explode(',', $theone['loupanid']);
			}
			else 
			{
				$theone = array('status' => 1, 'listorder' => 0);
			}
			if (checksubmit('submit')) 
			{
				$code = ((trim($_GPC['code']) ? trim($_GPC['code']) : message('请填写邀请码！')));
				$code1 = trim($_GPC['code1']);
				if (0 < $id) 
				{
					if ($code === $code1) 
					{
					}
					else 
					{
						$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_acmanager') . 'where uniacid =' . $uniacid);
						foreach ($codes as $c ) 
						{
							if ($code === $c['code']) 
							{
								message('已存在该邀请码请重新填写！');
							}
						}
					}
				}
				else 
				{
					$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_acmanager') . 'where uniacid =' . $uniacid);
					foreach ($codes as $c ) 
					{
						if ($code === $c['code']) 
						{
							message('已存在该邀请码请重新填写！');
						}
					}
				}
				$listorder = intval($_GPC['listorder']);
				$status = intval($_GPC['status']);
				$loupanid = $_GPC['loupanid'];
				$loupanid = explode(',', $loupanid);
				foreach ($loupanid as $key => $l ) 
				{
					if ($l == NULL) 
					{
						unset($loupanid[$key]);
					}
				}
				$loupanid = implode(',', $loupanid);
				$insert = array('uniacid' => $uniacid, 'code' => $code, 'listorder' => $listorder, 'status' => $status, 'content' => trim($_GPC['content']), 'loupanid' => $loupanid, 'createtime' => TIMESTAMP);
				if (empty($id)) 
				{
					pdo_insert('hc_deluxejjr_acmanager', $insert);
					(!pdo_insertid() ? message('保存经理数据失败, 请稍后重试.', 'error') : '');
				}
				else if (pdo_update('hc_deluxejjr_acmanager', $insert, array('id' => $id)) === false) 
				{
					message('更新经理数据失败, 请稍后重试.', 'error');
				}
				message('更新经理数据成功！', $this->createWebUrl('acmanager', array('op' => 'list')), 'success');
			}
			$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ', array(':uniacid' => $uniacid));
			$loupans = array();
			foreach ($loupan as $k => $v ) 
			{
				$loupans[$v['title']] = $v['id'];
			}
			include $this->template('web/acmanager_post');
		}
		if ($op == 'del') 
		{
			$temp = pdo_delete('hc_deluxejjr_acmanager', array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除数据失败！', $this->createWebUrl('acmanager', array('op' => 'list')), 'error');
			}
			else 
			{
				message('删除数据成功！', $this->createWebUrl('acmanager', array('op' => 'list')), 'success');
			}
		}
		if ($op == 'randomcode') 
		{
			$num = ((trim($_GPC['num']) ? trim($_GPC['num']) - 2 : 7));
			$num = intval($num);
			$randomcode = 'AC' . random($num, true);
			$code = pdo_fetchall('select code from' . tablename('hc_deluxejjr_acmanager') . 'where uniacid =' . $uniacid);
			if (0 < sizeof($code)) 
			{
				$i = 0;
				while ($i < sizeof($code)) 
				{
					if ($randomcode === $code[$i]['code']) 
					{
						$randomcode = 'AC' . random($num, true);
						$i = -1;
					}
					++$i;
				}
			}
			message($randomcode, '', 'ajax');
		}
		if ($op == 'acmanagerlist') 
		{
			include $this->template('web/acmanager_list');
		}
	}
	public function doWebCounselors() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($op == 'sort') 
		{
			$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid =' . $uniacid . '.and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid =' . $uniacid . '.and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
		}
		else 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid =' . $uniacid);
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
		}
		if ($op == 'status') 
		{
			$counselors = array('content' => trim($_GPC['content']), 'status' => $_GPC['status']);
			$temp = pdo_update('hc_deluxejjr_assistant', $counselors, array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('提交失败，请重新提交！', $this->createWebUrl('counselors', array('op' => 'showdetail', 'id' => $_GPC['id'])), 'error');
			}
			else 
			{
				message('提交成功！', $this->createWebUrl('counselors'), 'success');
			}
		}
		if ($_GPC['op'] == 'showdetail') 
		{
			$id = $_GPC['id'];
			$user = pdo_fetch('select * from' . tablename('hc_deluxejjr_assistant') . 'where id =' . $_GPC['id']);
			include $this->template('web/counselors_showdetail');
			exit();
		}
		if ($op == 'del') 
		{
			$code = pdo_fetchcolumn('select code from' . tablename('hc_deluxejjr_assistant') . 'where id =' . $_GPC['id']);
			$temp = pdo_delete('hc_deluxejjr_assistant', array('id' => $_GPC['id']));
			$c = pdo_fetchcolumn('select code from' . tablename('hc_deluxejjr_counselor') . 'where uniacid =' . $uniacid . ' and code =\'' . $code . '\'');
			if (!empty($c)) 
			{
				pdo_delete('hc_deluxejjr_counselor', array('code' => $c));
			}
			pdo_update('hc_deluxejjr_customer', array('cid' => 0), array('cid' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('删除失败，请重新删除！', $this->createWebUrl('counselors', array('op' => 'showdetail', 'id' => $_GPC['mid'])), 'error');
			}
			else 
			{
				message('删除成功！', $this->createWebUrl('counselors'), 'success');
			}
		}
		if ($op == 'allot') 
		{
			$op = 'allot';
			if (0 < $_GPC['id']) 
			{
				$id = intval($_GPC['id']);
				$update = array('cid' => $id, 'allottime' => time());
				$selected = explode(',', trim($_GPC['selected']));
				$cusids = '';
				$i = 0;
				while ($i < sizeof($selected)) 
				{
					$cusids = $cusids . $selected[$i] . ',';
					++$i;
				}
				$cusids = '(' . trim($cusids, ',') . ')';
				$customers = pdo_fetchall('select id, openid, loupan from ' . tablename('hc_deluxejjr_customer') . ' where id in ' . $cusids);
				$customer = array();
				foreach ($customers as $c ) 
				{
					$customer['openid'][$c['id']] = $c['openid'];
					$customer['loupan'][$c['id']] = $c['loupan'];
				}
				$loupans = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
				$loupan = array();
				foreach ($loupans as $l ) 
				{
					$loupan[$l['id']] = $l['title'];
				}
				$xs = pdo_fetch('select openid, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and id = ' . $id);
				$i = 0;
				while ($i < sizeof($selected)) 
				{
					$temp = pdo_update('hc_deluxejjr_customer', $update, array('id' => $selected[$i]));
					$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('customer');
					sendCustomerFP($customer['openid'][$selected[$i]], $xs['realname'], date('Y-m-d H:i:s', time()), $customer['loupan'][$selected[$i]], $url);
					$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('counselor');
					sendCustomerFP($xs['openid'], '项目经理', date('Y-m-d H:i:s', time()), $customer['loupan'][$selected[$i]], $url);
					++$i;
				}
				if (!$temp) 
				{
					message('分配失败，请重新分配！', $this->createWebUrl('customer'), 'error');
				}
				else 
				{
					message('分配成功！', $this->createWebUrl('customer', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $id)), 'success');
				}
			}
			else 
			{
				$selected = trim($_GPC['selected']);
			}
		}
		if ($op == 'mycustomer') 
		{
			exit();
		}
		include $this->template('web/counselors_show');
	}
	public function doWebAcmanagers() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$op = (($_GPC['op'] ? $_GPC['op'] : 'display'));
		if ($_GPC['op'] == 'sort') 
		{
			$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 1 and uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 1 and uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
		}
		else 
		{
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 1 and uniacid =' . $uniacid);
			$pager = pagination($total, $pindex, $psize);
			$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 1 and uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
		}
		if ($_GPC['op'] == 'status') 
		{
			$counselors = array('content' => trim($_GPC['content']), 'status' => $_GPC['status']);
			$temp = pdo_update('hc_deluxejjr_assistant', $counselors, array('id' => $_GPC['id']));
			if (empty($temp)) 
			{
				message('提交失败，请重新提交！', $this->createWebUrl('acmanagers', array('op' => 'showdetail', 'id' => $_GPC['id'])), 'error');
			}
			else 
			{
				message('提交成功！', $this->createWebUrl('acmanagers'), 'success');
			}
		}
		if ($_GPC['op'] == 'showdetail') 
		{
			$id = $_GPC['id'];
			$user = pdo_fetch('select a.*, ac.loupanid, ac.id as codeid from' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_acmanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code where a.id =' . $_GPC['id']);
			$loupanids = explode(',', $user['loupanid']);
			$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ', array(':uniacid' => $uniacid));
			$loupans = array();
			foreach ($loupan as $k => $v ) 
			{
				$loupans[$v['id']] = $v['title'];
			}
			include $this->template('web/acmanagers_showdetail');
			exit();
		}
		if ($_GPC['op'] == 'del') 
		{
			$code = pdo_fetchcolumn('select code from' . tablename('hc_deluxejjr_assistant') . 'where id =' . $_GPC['id']);
			$temp = pdo_delete('hc_deluxejjr_assistant', array('id' => $_GPC['id']));
			$temp = pdo_delete('hc_deluxejjr_acmanager', array('code' => $code));
			if (empty($temp)) 
			{
				message('删除失败，请重新删除！', $this->createWebUrl('acmanagers', array('op' => 'showdetail', 'id' => $_GPC['mid'])), 'error');
			}
			else 
			{
				message('删除成功！', $this->createWebUrl('acmanagers'), 'success');
			}
		}
		include $this->template('web/acmanagers_show');
	}
	public function doWebAdv() 
	{
		global $_W;
		global $_GPC;
		load()->func('tpl');
		$operation = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		if ($operation == 'display') 
		{
			$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_adv') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY displayorder DESC');
		}
		else if ($operation == 'post') 
		{
			$id = intval($_GPC['id']);
			if (checksubmit('submit')) 
			{
				$data = array('uniacid' => $_W['uniacid'], 'link' => $_GPC['link'], 'enabled' => intval($_GPC['enabled']), 'displayorder' => intval($_GPC['displayorder']));
				if (!empty($_GPC['thumb'])) 
				{
					$data['thumb'] = $_GPC['thumb'];
				}
				if (!empty($id)) 
				{
					pdo_update('hc_deluxejjr_adv', $data, array('id' => $id));
				}
				else 
				{
					pdo_insert('hc_deluxejjr_adv', $data);
					$id = pdo_insertid();
				}
				message('更新幻灯片成功！', $this->createWebUrl('adv', array('op' => 'display')), 'success');
			}
			$adv = pdo_fetch('select * from ' . tablename('hc_deluxejjr_adv') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		else if ($operation == 'delete') 
		{
			$id = intval($_GPC['id']);
			$adv = pdo_fetch('SELECT id  FROM ' . tablename('hc_deluxejjr_adv') . ' WHERE id = \'' . $id . '\' AND uniacid=' . $_W['uniacid'] . '');
			if (empty($adv)) 
			{
				message('抱歉，幻灯片不存在或是已经被删除！', $this->createWebUrl('adv', array('op' => 'display')), 'error');
			}
			pdo_delete('hc_deluxejjr_adv', array('id' => $id));
			message('幻灯片删除成功！', $this->createWebUrl('adv', array('op' => 'display')), 'success');
		}
		else 
		{
			message('请求方式不存在');
		}
		include $this->template('web/adv');
	}
	public function doWebItem() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$lpid = intval($_GPC['lpid']);
		$photoid = intval($_GPC['photoid']);
		$id = intval($_GPC['id']);
		$photo = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE id = :id', array(':id' => $photoid));
		if (empty($photo)) 
		{
			message('场景不存在或是已经被删除！');
		}
		if (!empty($id)) 
		{
			$item = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_item') . ' WHERE id = :id', array(':id' => $id));
		}
		include $this->template('web/item');
	}
	public function doWebQuery() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		checklogin();
		$kwd = $_GPC['keyword'];
		$sql = 'SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid`=:uniacid AND `title` LIKE :title';
		$params = array();
		$params[':uniacid'] = $uniacid;
		$params[':title'] = '%' . $kwd . '%';
		$ds = pdo_fetchall($sql, $params);
		foreach ($ds as &$row ) 
		{
			$r = array();
			$r['id'] = $row['id'];
			$r['title'] = $row['title'];
			$r['description'] = $row['content'];
			$r['thumb'] = $row['thumb'];
			$row['entry'] = $r;
		}
		include $this->template('web/query');
	}
	public function doWebOutput() 
	{
		global $_W;
		global $_GPC;
		$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid  ', array(':uniacid' => $_W['uniacid']), 'id');
		$pstatus = $this->ProcessStatus();
		load()->func('tpl');
		include $this->template('web/customer_output');
	}
	public function doWebdownload() 
	{
		global $_W;
		global $_GPC;
		checklogin();
		$uniacid = $_W['uniacid'];
		$this->__web('doWebdownload');
	}
	public function doWebXlsupload() 
	{
		global $_W;
		global $_GPC;
		$op = $_GPC['op'];
		$uniacid = $_W['uniacid'];
		if ($op == 'import') 
		{
			include_once 'lib/reader.php';
			$tmp = $_FILES['file']['tmp_name'];
			$ext = end(explode('.', $_FILES['file']['name']));
			$ext = strtolower($ext);
			if (($ext != 'xls') || empty($tmp)) 
			{
				$str = '只支持xls文件！';
			}
			else 
			{
				$sheets = array();
				$path = $_W['config']['upload']['attachdir'];
				if (!is_dir('../' . $path . '/xls')) 
				{
					mkdir('../' . $path . '/xls', 511);
				}
				$save_path = $_W['config']['upload']['attachdir'] . '/xls/';
				$file_name = '../' . $save_path . date('Ymdhis') . '.xls';
				if (copy($tmp, $file_name)) 
				{
					$xls = new Spreadsheet_Excel_Reader();
					$xls->setOutputEncoding('utf-8');
					$xls->read($file_name);
					$createtime = TIMESTAMP;
					$numRows = $xls->sheets[0]['numRows'];
					$suscess_row = 0;
					$error_row = 0;
					$data = array('createtime' => $createtime, 'uniacid' => $uniacid);
					$i = 2;
					while ($i <= $numRows) 
					{
						$sheets1 = $xls->sheets[0]['cells'][$i][1];
						$sheets2 = $xls->sheets[0]['cells'][$i][2];
						$data['cname'] = $sheets1;
						$data['mobile'] = $sheets2;
						if ($i < 12) 
						{
							$data_values .= ' <tr><td>' . $i . '</td> <td> ' . $sheets1 . '</td> <td> ' . $sheets2 . '</td> </tr> ';
						}
						if (pdo_insert('hc_deluxejjr_protect', $data)) 
						{
							++$suscess_row;
						}
						else 
						{
							++$error_row;
						}
						++$i;
					}
					$str = $suscess_row . ' 条记录导入成功</br>';
					$str .= $error_row . ' 条记录导入失败</br>';
					$str .= '您的EXCEL数据：</br></br><table width=600 border=1 cellpadding=0 cellspacing=0 bordercolor="#CCCCCC">';
					$str .= $data_values;
					$str .= '</table>';
				}
				else 
				{
					$str = '请正确上传XLS文件';
				}
			}
		}
		include $this->template('web/import');
	}
	private function ProcessStatus() 
	{
		global $_W;
		$cusstas = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE `uniacid` = :uniacid order by displayorder asc', array(':uniacid' => $_W['uniacid']));
		$status = array();
		if (!empty($cusstas)) 
		{
			foreach ($cusstas as $key => $c ) 
			{
				$status[$key] = $c['title'];
			}
		}
		return $status;
	}
	public function doWebUploadMusic() 
	{
		global $_W;
		checklogin();
		if (empty($_FILES['imgFile']['name'])) 
		{
			$result['message'] = '请选择要上传的音乐！';
			exit(json_encode($result));
		}
		if ($_FILES['imgFile']['error'] != 0) 
		{
			$result['message'] = '上传失败，请重试！';
			exit(json_encode($result));
		}
		if ($file = $this->fileUpload($_FILES['imgFile'], 'music')) 
		{
			if (!$file['success']) 
			{
				exit(json_encode($file));
			}
			$result['url'] = $_W['config']['upload']['attachdir'] . $file['path'];
			$result['error'] = 0;
			$result['filename'] = $file['path'];
			exit(json_encode($result));
		}
	}
	private function fileUpload($file, $type) 
	{
		global $_W;
		set_time_limit(0);
		$_W['uploadsetting'] = array();
		$_W['uploadsetting']['music']['folder'] = 'music';
		$_W['uploadsetting']['music']['extentions'] = array('mp3', 'wma', 'wav', 'amr');
		$_W['uploadsetting']['music']['limit'] = 50000;
		$result = array();
		$upload = file_upload($file, 'music');
		if (is_error($upload)) 
		{
			message($upload['message'], '', 'ajax');
		}
		$result['url'] = $upload['url'];
		$result['error'] = 0;
		$result['filename'] = $upload['path'];
		return $result;
	}
	public function doMobileUserinfo() 
	{
		global $_GPC;
		global $_W;
		$uniacid = $_W['uniacid'];
		load()->func('communication');
		if ($_GPC['code'] == 'authdeny') 
		{
			$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array(), true);
			header('location:' . $url);
			exit('authdeny');
		}
		if (isset($_GPC['code'])) 
		{
			$appid = $_W['account']['key'];
			$secret = $_W['account']['secret'];
			$serverapp = $_W['account']['level'];
			if ($serverapp != 4) 
			{
				$cfg = $this->module['config'];
				$appid = $cfg['appid'];
				$secret = $cfg['secret'];
				if (empty($appid) || empty($secret)) 
				{
					return;
				}
			}
			$state = $_GPC['state'];
			$code = $_GPC['code'];
			$oauth2_code = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
			$content = ihttp_get($oauth2_code);
			$token = @json_decode($content['content'], true);
			if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) 
			{
				echo '<h1>获取微信公众号授权' . $code . '失败[无法取得token以及openid], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'] . '<h1>';
				exit();
			}
			$openid = $token['openid'];
			$profile = pdo_fetch('select * from ' . tablename('mc_mapping_fans') . ' where uniacid = ' . $uniacid . ' and openid = \'' . $openid . '\'');
			if ($profile['follow'] == 1) 
			{
				$state = 1;
			}
			else 
			{
				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('userinfo', array(), true);
				$oauth2_code = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect';
			}
			$access_token = $token['access_token'];
			$oauth2_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
			$content = ihttp_get($oauth2_url);
			$info = @json_decode($content['content'], true);
			if (empty($info) || !is_array($info) || empty($info['openid']) || empty($info['nickname'])) 
			{
				echo '<h1>获取微信公众号授权失败[无法取得info], 请稍后重试！<h1>';
				exit();
			}
			if (!empty($_W['member']['uid'])) 
			{
				$row = array('uniacid' => $uniacid, 'nickname' => $info['nickname'], 'avatar' => $info['headimgurl'], 'realname' => $info['nickname']);
				pdo_update('mc_members', $row, array('uid' => $_W['member']['uid']));
			}
			else 
			{
				$default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' . tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $uniacid));
				$row = array('uniacid' => $uniacid, 'nickname' => $info['nickname'], 'avatar' => $info['headimgurl'], 'realname' => $info['nickname'], 'groupid' => $default_groupid, 'email' => random(32) . '@we7.cc', 'salt' => random(8), 'createtime' => time());
				pdo_insert('mc_members', $row);
				$user['uid'] = pdo_insertid();
				pdo_update('mc_mapping_fans', array('uid' => $user['uid']), array('openid' => $openid, 'uniacid' => $uniacid));
				_mc_login($user);
			}
			$cookie = 'hc_deluxejjr_cookie' . $_W['uniacid'];
			setcookie($cookie, 'a', time() + (3600 * 24 * 15));
			$url = $this->createMobileUrl('register');
			header('location:' . $url);
			exit();
			return;
		}
		echo '<h1>网页授权域名设置出错!</h1>';
		exit();
	}
	private function CheckCookie() 
	{
		global $_W;
		$cookie = 'hc_deluxejjr_cookie' . $_W['uniacid'];
		if (empty($_COOKIE[$cookie])) 
		{
			$appid = $_W['account']['key'];
			$secret = $_W['account']['secret'];
			$serverapp = $_W['account']['level'];
			if ($serverapp != 4) 
			{
				$cfg = $this->module['config'];
				$appid = $cfg['appid'];
				$secret = $cfg['secret'];
				if (empty($appid) || empty($secret)) 
				{
					return;
				}
			}
			$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('userinfo', array(), true);
			$oauth2_code = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect';
			header('location:' . $oauth2_code);
			exit();
		}
	}
}
function getTopDomainhuo() 
{
	$host = $_SERVER['HTTP_HOST'];
	$host = strtolower($host);
	if (strpos($host, '/') !== false) 
	{
		$parse = @parse_url($host);
		$host = $parse['host'];
	}
	$topleveldomaindb = array('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'top', 'wang', 'pro', 'name', 'so', 'in', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'co', 'asia');
	$str = '';
	foreach ($topleveldomaindb as $v ) 
	{
		$str .= (($str ? '|' : '')) . $v;
	}
	$matchstr = '[^\\.]+\\.(?:(' . $str . ')|\\w{2}|((' . $str . ')\\.\\w{2}))$';
	if (preg_match('/' . $matchstr . '/ies', $host, $matchs)) 
	{
		$domain = $matchs[0];
	}
	else 
	{
		$domain = $host;
	}
	return $domain;
}
function pagination1($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => '')) 
{
	global $_W;
	$pdata = array('tcount' => 0, 'tpage' => 0, 'cindex' => 0, 'findex' => 0, 'pindex' => 0, 'nindex' => 0, 'lindex' => 0, 'options' => '');
	if ($context['ajaxcallback']) 
	{
		$context['isajax'] = true;
	}
	$pdata['tcount'] = $tcount;
	$pdata['tpage'] = ceil($tcount / $psize);
	if ($pdata['tpage'] <= 1) 
	{
		return '';
	}
	$cindex = $pindex;
	$cindex = min($cindex, $pdata['tpage']);
	$cindex = max($cindex, 1);
	$pdata['cindex'] = $cindex;
	$pdata['findex'] = 1;
	$pdata['pindex'] = ((1 < $cindex ? $cindex - 1 : 1));
	$pdata['nindex'] = (($cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage']));
	$pdata['lindex'] = $pdata['tpage'];
	if ($context['isajax']) 
	{
		if (!$url) 
		{
			$url = $_W['script_name'] . '?' . http_build_query($_GET);
		}
		$pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
		$pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
	}
	else if ($url) 
	{
		$pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
		$pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
		$pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
		$pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
	}
	else 
	{
		$_GET['page'] = $pdata['findex'];
		$pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
		$_GET['page'] = $pdata['pindex'];
		$pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
		$_GET['page'] = $pdata['nindex'];
		$pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
		$_GET['page'] = $pdata['lindex'];
		$pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
	}
	$html = '<div class="pagination pagination-centered"><ul>';
	if (1 < $pdata['cindex']) 
	{
		$html .= '<li><a ' . $pdata['faa'] . ' class="pager-nav">首页</a></li>';
		$html .= '<li><a ' . $pdata['paa'] . ' class="pager-nav">&laquo;上一页</a></li>';
	}
	if (!$context['before'] && ($context['before'] != 0)) 
	{
		$context['before'] = 5;
	}
	if (!$context['after'] && ($context['after'] != 0)) 
	{
		$context['after'] = 4;
	}
	if (($context['after'] != 0) && ($context['before'] != 0)) 
	{
		$range = array();
		$range['start'] = max(1, $pdata['cindex'] - $context['before']);
		$range['end'] = min($pdata['tpage'], $pdata['cindex'] + $context['after']);
		if (($range['end'] - $range['start']) < ($context['before'] + $context['after'])) 
		{
			$range['end'] = min($pdata['tpage'], $range['start'] + $context['before'] + $context['after']);
			$range['start'] = max(1, $range['end'] - $context['before'] - $context['after']);
		}
		$i = $range['start'];
		while ($i <= $range['end']) 
		{
			if ($context['isajax']) 
			{
				$aa = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $i . '\', ' . $context['ajaxcallback'] . ')"';
			}
			else if ($url) 
			{
				$aa = 'href="?' . str_replace('*', $i, $url) . '"';
			}
			else 
			{
				$_GET['page'] = $i;
				$aa = 'href="?' . http_build_query($_GET) . '"';
			}
			++$i;
		}
	}
	if ($pdata['cindex'] < $pdata['tpage']) 
	{
		$html .= '<li><a ' . $pdata['naa'] . ' class="pager-nav">下一页&raquo;</a></li>';
		$html .= '<li><a ' . $pdata['laa'] . ' class="pager-nav">尾页</a></li>';
	}
	$html .= '</ul></div>';
	return $html;
}
function hehe($string = NULL) 
{
	$name = $string;
	preg_match_all('/./us', $string, $match);
	if (5 < count($match[0])) 
	{
		$mname = '';
		$i = 0;
		while ($i < 5) 
		{
			$mname = $mname . $match[0][$i];
			++$i;
		}
		$name = $mname . '..';
	}
	return $name;
}
function hehe1($string = NULL) 
{
	$name = $string;
	preg_match_all('/./us', $string, $match);
	if (10 < count($match[0])) 
	{
		$mname = '';
		$i = 0;
		while ($i < 10) 
		{
			$mname = $mname . $match[0][$i];
			++$i;
		}
		$name = $mname . '..';
	}
	return $name;
}
function haha($indate = 0, $indatetime = 0) 
{
	$usetime = time() - $indatetime;
	$days = ceil($usetime / 86400);
	$indays = $indate - $days;
	if ($indays < 0) 
	{
		return '已过期';
	}
	if ($indays == 0) 
	{
		$daystime = $days * 86400;
		$hours = ceil(($daystime - $usetime) / 3600);
		return '剩余' . $hours . '小时';
	}
	return '剩余' . $indays . '天';
}
function hoho($mobile) 
{
	if (preg_match('/1[3458]{1}\\d{9}$/', $mobile)) 
	{
		return $mobile;
	}
	return '无效号码';
}
function hoho1($phone) 
{
	$IsWhat = preg_match('/(0[0-9]{2,3}[\\-]?[2-9][0-9]{6,7}[\\-]?[0-9]?)/i', $phone);
	if ($IsWhat == 1) 
	{
		return preg_replace('/(0[0-9]{2,3}[\\-]?[2-9])[0-9]{3,4}([0-9]{3}[\\-]?[0-9]?)/i', '$1****$2', $phone);
	}
	return preg_replace('/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i', '$1****$2', $phone);
}
function sendStatusChange($openid, $customName, $customPhone, $reportBuilding, $reportTime, $change, $changeTime, $remark) 
{
	global $_W;
	$template_id = pdo_fetchcolumn('select StatusChange from ' . tablename('hc_deluxejjr_templatenews') . ' where uniacid = ' . $_W['uniacid']);
	if (!empty($template_id)) 
	{
		$datas = array( 'first' => array('value' => '客户状态变动', 'color' => '#173177'), 'customName' => array('value' => $customName, 'color' => '#173177'), 'customPhone' => array('value' => $customPhone, 'color' => '#173177'), 'reportBuilding' => array('value' => $reportBuilding, 'color' => '#173177'), 'reportTime' => array('value' => $reportTime, 'color' => '#173177'), 'change' => array('value' => $change, 'color' => '#173177'), 'changeTime' => array('value' => $changeTime, 'color' => '#173177'), 'remark' => array('value' => $remark, 'color' => '#173177') );
		$data = json_encode($datas);
	}
	if (!empty($template_id)) 
	{
		$accountid = pdo_fetch('select * from ' . tablename('account_wechats') . ' where uniacid = ' . $_W['uniacid']);
		$appid = $accountid['key'];
		$appSecret = $accountid['secret'];
		if (empty($url)) 
		{
			$url = '';
		}
		else 
		{
			$url = $url;
		}
		$sendopenid = $openid;
		$topcolor = '#FF0000';
		tempmsg($template_id, $url, $data, $topcolor, $sendopenid, $appid, $appSecret);
	}
}
function sendCommission($openid, $customName, $customPhone, $reportBuilding, $reportTime, $signAmount, $signTime, $commissionAmount, $commissionTime) 
{
	global $_W;
	$template_id = pdo_fetchcolumn('select Commission from ' . tablename('hc_deluxejjr_templatenews') . ' where uniacid = ' . $_W['uniacid']);
	if (!empty($template_id)) 
	{
		$datas = array( 'first' => array('value' => '有一笔客户成交佣金已发放至您的账户！', 'color' => '#173177'), 'customName' => array('value' => $customName, 'color' => '#173177'), 'customPhone' => array('value' => $customPhone, 'color' => '#173177'), 'reportBuilding' => array('value' => $reportBuilding, 'color' => '#173177'), 'reportTime' => array('value' => $reportTime, 'color' => '#173177'), 'signAmount' => array('value' => $signAmount, 'color' => '#173177'), 'signTime' => array('value' => $signTime, 'color' => '#173177'), 'commissionAmount' => array('value' => $commissionAmount, 'color' => '#173177'), 'commissionTime' => array('value' => $commissionTime, 'color' => '#173177'), 'remark' => array('value' => '恭喜您，请继续推荐客户！', 'color' => '#173177') );
		$data = json_encode($datas);
	}
	if (!empty($template_id)) 
	{
		$accountid = pdo_fetch('select * from ' . tablename('account_wechats') . ' where uniacid = ' . $_W['uniacid']);
		$appid = $accountid['key'];
		$appSecret = $accountid['secret'];
		if (empty($url)) 
		{
			$url = '';
		}
		else 
		{
			$url = $url;
		}
		$sendopenid = $openid;
		$topcolor = '#FF0000';
		tempmsg($template_id, $url, $data, $topcolor, $sendopenid, $appid, $appSecret);
	}
}
function sendCreditChange($openid, $keyword1, $keyword2, $keyword3, $url) 
{
	global $_W;
	$template_id = pdo_fetchcolumn('select CreditChange from ' . tablename('hc_deluxejjr_templatenews') . ' where uniacid = ' . $_W['uniacid']);
	if (!empty($template_id)) 
	{
		$datas = array( 'first' => array('value' => '您的会员账户增加' . $keyword3 . '积分', 'color' => '#173177'), 'keyword1' => array('value' => $keyword1, 'color' => '#173177'), 'keyword2' => array('value' => $keyword2, 'color' => '#173177'), 'keyword3' => array('value' => $keyword3 . '分', 'color' => '#173177'), 'remark' => array('value' => '详情请点击查看！', 'color' => '#173177') );
		$data = json_encode($datas);
	}
	if (!empty($template_id)) 
	{
		$accountid = pdo_fetch('select * from ' . tablename('account_wechats') . ' where uniacid = ' . $_W['uniacid']);
		$appid = $accountid['key'];
		$appSecret = $accountid['secret'];
		if (empty($url)) 
		{
			$url = '';
		}
		else 
		{
			$url = $url;
		}
		$sendopenid = $openid;
		$topcolor = '#FF0000';
		tempmsg($template_id, $url, $data, $topcolor, $sendopenid, $appid, $appSecret);
	}
}
function sendCustomerFP($openid, $keynote1, $keynote2, $keynote3, $url) 
{
	global $_W;
	$template_id = pdo_fetchcolumn('select CustomerFP from ' . tablename('hc_deluxejjr_templatenews') . ' where uniacid = ' . $_W['uniacid']);
	if (!empty($template_id)) 
	{
		$datas = array( 'first' => array('value' => $keynote1 . '，你好：您收到一条新的待处理订单，请点击“详情”进行处理。祝您交易顺利。', 'color' => '#173177'), 'keynote1' => array('value' => $keynote1, 'color' => '#173177'), 'keynote2' => array('value' => $keynote2, 'color' => '#173177'), 'keynote3' => array('value' => $keynote3, 'color' => '#173177'), 'remark' => array('value' => '记得及时处理订单哦~', 'color' => '#173177') );
		$data = json_encode($datas);
	}
	if (!empty($template_id)) 
	{
		$accountid = pdo_fetch('select * from ' . tablename('account_wechats') . ' where uniacid = ' . $_W['uniacid']);
		$appid = $accountid['key'];
		$appSecret = $accountid['secret'];
		if (empty($url)) 
		{
			$url = '';
		}
		else 
		{
			$url = $url;
		}
		$sendopenid = $openid;
		$topcolor = '#FF0000';
		tempmsg($template_id, $url, $data, $topcolor, $sendopenid, $appid, $appSecret);
	}
}
function tempmsg($template_id, $url, $data, $topcolor, $sendopenid, $appid, $appSecret) 
{
	load()->func('communication');
	if ($data->expire_time < time()) 
	{
		$url1 = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appSecret . '';
		$res = json_decode(httpGet($url1));
		$tokens = $res->access_token;
		if (empty($tokens)) 
		{
			return;
		}
		$postarr = '{"touser":"' . $sendopenid . '","template_id":"' . $template_id . '","url":"' . $url . '","topcolor":"' . $topcolor . '","data":' . $data . '}';
		$res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $tokens, $postarr);
	}
}
function httpGet($url) 
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_URL, $url);
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}
?>