<?php





defined('IN_IA') or exit('Access Denied');

	    load()->func('file');

		load()->func('tpl');

		global $_W,$_GPC;

		$uniacid = intval($_W['uniacid']);

		$id = intval($_GPC['id']);
        $baiduapikey=$this->module['config']['baiduapikey'];
		$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND id = :id", array(':uniacid' => $uniacid,':id' => $id));

		if (empty($redata)) {

            $now = time();

            $redata = array(       

                "starttime" => $now,

                "endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),

            );

        }



        if ($_W['ispost']) {

			if (empty($_GPC['act_name'])) {

				message('活动名称不能为空！');

			}

            if (empty($_GPC['send_name'])) {

				message('商户名称不能为空！');

			}

			if (empty($_GPC['wishing'])) {

				message('红包祝福语不能为空！');

			}



			if (empty($_GPC['remark'])) {

				message('备注不能为空！');

			}



			$d = $_GPC['datelimit'];

            $data = array(

			    'uniacid' => $uniacid,

                'act_name' => $_GPC['act_name'],

				'send_name' => $_GPC['send_name'],

                'wishing' => $_GPC['wishing'],

                'starttime' => strtotime($d['start']),

				'endtime' => strtotime($d['end']),

				'secret_key' => $_GPC['secret_key'],

				'uuid' => $_GPC['uuid'],

				'remark' => $_GPC['remark'],
				
				'onlyshare'=>$_GPC['onlyshare'],
				
				'area'=>$_GPC['area'],
				
				

				'description' => htmlspecialchars_decode($_GPC['description']),

				//'createtime'=> time(),

            );

			if (!empty($_GPC['password'])) {//验证管理员密码

				$member['username'] = $_W['user']['username'];

				$member['password'] = $_GPC['password'];

				load()->model('user');

				$record = user_single($member);

				if($record['username']==$_W['user']['username']){

				   $data['ispay']=$_GPC['ispay'];	

				}else{

				   message('管理员密码错误');

				}

			}

            if (!empty($redata['id'])) {

                pdo_update('tyzm_redpack_lists', $data, array('id' => $redata['id']));

            } else {

                pdo_insert('tyzm_redpack_lists', $data);

            }			

			message('活动设置成功！', $this->createWebUrl('manage', array('name' => 'tyzm_redpack')), 'success');



        }

	    include $this->template('create');







	











