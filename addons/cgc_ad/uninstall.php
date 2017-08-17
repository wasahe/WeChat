<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_cgc_ad_adv`;
DROP TABLE IF EXISTS `ims_cgc_ad_banner`;
DROP TABLE IF EXISTS `ims_cgc_ad_couponc`;
DROP TABLE IF EXISTS `ims_cgc_ad_group`;
DROP TABLE IF EXISTS `ims_cgc_ad_help`;
DROP TABLE IF EXISTS `ims_cgc_ad_member`;
DROP TABLE IF EXISTS `ims_cgc_ad_message`;
DROP TABLE IF EXISTS `ims_cgc_ad_paylog`;
DROP TABLE IF EXISTS `ims_cgc_ad_poster`;
DROP TABLE IF EXISTS `ims_cgc_ad_pv`;
DROP TABLE IF EXISTS `ims_cgc_ad_quan`;
DROP TABLE IF EXISTS `ims_cgc_ad_red`;
DROP TABLE IF EXISTS `ims_cgc_ad_rule`;
DROP TABLE IF EXISTS `ims_cgc_ad_setting`;
DROP TABLE IF EXISTS `ims_cgc_ad_task`;
DROP TABLE IF EXISTS `ims_cgc_ad_tx`;
DROP TABLE IF EXISTS `ims_cgc_ad_vip_pay`;
DROP TABLE IF EXISTS `ims_cgc_ad_vip_rule`;
DROP TABLE IF EXISTS `ims_cgc_ad_yure`;
DROP TABLE IF EXISTS `ims_cgc_addr_group`;
DROP TABLE IF EXISTS `ims_cgc_share_member`;
DROP TABLE IF EXISTS `ims_cgc_share_record`;
DROP TABLE IF EXISTS `ims_cgc_share_url`;
DROP TABLE IF EXISTS `ims_cgc_share_user`;
DROP TABLE IF EXISTS `ims_cgc_share_vip`;
EOF;
pdo_run($sql);