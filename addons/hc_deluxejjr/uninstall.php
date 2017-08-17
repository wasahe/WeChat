<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_hc_deluxejjr_acmanager`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_adv`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_assistant`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_commission`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_complain`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_counselor`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_credit`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_creditlog`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_cusmat`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_cusmatlog`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_cuspool`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_customer`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_customerstatus`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_experience`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_explevel`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_idcommission`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_identity`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_item`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_jjrcode`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_log`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_logloupan`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_loupan`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_member`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_photo`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_poster`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_promanager`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_protect`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_question`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_rule`;
DROP TABLE IF EXISTS `ims_hc_deluxejjr_templatenews`;
EOF;
pdo_run($sql);