<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_114';

$Hooks = array(
    'forumdisplay_topBar',
);

$data = array();
foreach ($Hooks as $Hook) {
    $data[] = array(
        $Hook => array(
            'plugin' => $pluginid,
            'include' => 'api.class.php',
            'class' => $pluginid,
            'method' => $Hook)
    );
}

$sql = <<<SQL
ALTER TABLE `pre_plugin_xigua114` ADD INDEX(`city`);

ALTER TABLE `pre_plugin_xigua114` ADD INDEX(`dist`);

ALTER TABLE `pre_plugin_xigua114` CHANGE `cover` `cover` TEXT NOT NULL;

ALTER TABLE pre_plugin_xigua114 DROP INDEX phone;

ALTER TABLE `pre_plugin_xigua114` ADD INDEX(`phone`);

SQL;

$r2 = DB::fetch_first('SHOW COLUMNS FROM %t  where `Field`=\'shares\'', array('plugin_xigua114'), true);
if(!$r2){
    $sql .= <<<SQL

ALTER TABLE `pre_plugin_xigua114` ADD `views` INT(11) NOT NULL DEFAULT '0'; 

ALTER TABLE `pre_plugin_xigua114` ADD `shares` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `pre_plugin_xigua114` ADD INDEX(`shares`);

ALTER TABLE `pre_plugin_xigua114` ADD INDEX(`views`);
SQL;
}
$r3 = DB::fetch_first('SHOW COLUMNS FROM %t  where `Field`=\'lat\'', array('plugin_xigua114'), true);
if(!$r3){
    $sql .= <<<SQL
    
ALTER TABLE `pre_plugin_xigua114` ADD `lat` VARCHAR(20) NOT NULL;

ALTER TABLE `pre_plugin_xigua114` ADD `lng` VARCHAR(20) NOT NULL;

SQL;
}

runquery($sql);


@include_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
WeChatHook::updateAPIHook($data);

$finish = TRUE;