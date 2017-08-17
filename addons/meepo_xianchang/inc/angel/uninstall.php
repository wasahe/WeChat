<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_meepo_xianchang_3d_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_basic_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_bd`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_bd_data`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_cookie`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_jb`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_lottory_award`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_lottory_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_lottory_user`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_qd`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_qd_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_redpack_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_redpack_rotate`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_redpack_user`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_rid`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_shake_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_shake_rotate`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_shake_user`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_user`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_vote`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_vote_record`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_vote_xms`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_wall`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_wall_config`;
DROP TABLE IF EXISTS `ims_meepo_xianchang_xc`;
EOF;
pdo_run($sql);