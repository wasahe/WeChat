<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_haoman_updatehb_addad`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_award`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_baoming`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_cardticket`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_cash`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_data`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_fans`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_hb`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_jiequan`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_password`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_pici`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_prize`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_pw`;
DROP TABLE IF EXISTS `ims_haoman_updatehb_reply`;
EOF;
pdo_run($sql);