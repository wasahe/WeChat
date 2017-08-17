<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$find = array(
    'resource/template/',
    'resource/developer/',
    'resource/plugin/',
    'resource/event/',
    'image/scrolltop.png',
);
$replace = array(
    'http://addon.discuz.com/resource/template/',
    'http://addon.discuz.com/resource/developer/',
    'http://addon.discuz.com/resource/plugin/',
    'http://addon.discuz.com/resource/event/',
    'http://addon.discuz.com/image/scrolltop.png',
);


$s = str_replace($find, $replace, dfsockopen('http://addon.discuz.com/?@7402.developer'));

global $_G;
$charset = $_G['charset'] ? strtoupper($_G['charset']) : strtoupper(CHARSET);
echo '<style type="text/css">#header,.a_tb,.devcat{display:none!important;}#share_txt{display:inline-block!important;  margin-right: 10px;}</style>';
echo iconv('GBK', $charset, $s);