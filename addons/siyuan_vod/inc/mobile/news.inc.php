<?php


defined('IN_IA') || exit('Access Denied');
$obj = new Siyuan_Vod_doMobileNews();
$obj->exec();
class Siyuan_Vod_doMobileNews extends Siyuan_VodModuleSite
{
	public function exec()
	{
		global $_W;
		global $_GPC;
		$set = pdo_fetch('SELECT name,ad,logo,qr,color,top_logo,fengge,open,ad_pic,ad_url,bottom_name,bottom_ad,bottom_logo,tishi,bottom_qr,share_url FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));
		$play = pdo_fetch('SELECT videojj_key FROM ' . tablename('siyuan_vod_play_set') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));

		if ($set['open'] == '0') {
			$this->Checkeduseragent();
		}


		$so = pdo_fetchall('SELECT id,displayorder,title,vid FROM ' . tablename('siyuan_vod_so') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder DESC LIMIT 20');
		$menu = pdo_fetchall('SELECT title,url,displayorder,thumb FROM ' . tablename('siyuan_vod_menu') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder ASC LIMIT 30');
		$id = intval($_GPC['id']);
		$vid = intval($_GPC['vid']);
		$news = pdo_fetch('SELECT id,title,yuedu,thumb,slei,body,play FROM ' . tablename('siyuan_vod') . ' WHERE `id` = ' . $id);
		$news['kvs'] = pdo_fetchAll('SELECT id,vid,url,displayorder,ji FROM ' . tablename('siyuan_vod_kv') . ' WHERE `vid` = ' . $id . ' ORDER BY displayorder DESC');

		if ($vid) {
			$kv = pdo_fetch('SELECT id,vid,url,ji FROM ' . tablename('siyuan_vod_kv') . ' WHERE `id` = ' . $vid);
		}
		 else {
			$kv = pdo_fetch('SELECT id,vid,url,ji FROM ' . tablename('siyuan_vod_kv') . ' WHERE `vid` = ' . $news['id']);
		}

		$title = $news['title'];
		$list = pdo_fetchall('SELECT id,time,title,thumb,shuxing,lianzai,slei FROM ' . tablename('siyuan_vod') . ' WHERE weid = ' . $_W['uniacid'] . ' and slei = ' . $news['slei'] . ' ORDER BY time DESC LIMIT 9');
		pdo_update('siyuan_vod', array('yuedu' => $news['yuedu'] + 1), array('id' => $news['id']));
		include $this->template('news');
	}
}

