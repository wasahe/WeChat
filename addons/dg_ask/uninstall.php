<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_chat_ask`;
DROP TABLE IF EXISTS `ims_chat_ask_answer`;
DROP TABLE IF EXISTS `ims_chat_ask_banner`;
DROP TABLE IF EXISTS `ims_chat_ask_follow`;
DROP TABLE IF EXISTS `ims_chat_ask_score`;
DROP TABLE IF EXISTS `ims_chat_ask_share`;
DROP TABLE IF EXISTS `ims_chat_ask_summary`;
DROP TABLE IF EXISTS `ims_chat_ask_summary_last`;
DROP TABLE IF EXISTS `ims_chat_ask_tags`;
DROP TABLE IF EXISTS `ims_chat_users`;
EOF;
pdo_run($sql);