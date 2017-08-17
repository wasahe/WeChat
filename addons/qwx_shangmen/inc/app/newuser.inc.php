<?php
/**
 * 上门服务美容美发预约到家
 *
 * [3354988381] Copyright (c) 20160529
 */
/**
 * 上-门-服-务-美-容-美-发-预-约-到-家
 */
defined('IN_IA') or exit('Access Denied');

global $_W, $_GPC;
$page_title = '新手通道';
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

if ($op == 'display') {


    include $this->template('index-newuser');
}















