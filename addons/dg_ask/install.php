<?php

$sql =<<<EOF

CREATE TABLE IF NOT EXISTS `ims_chat_ask` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `pay_money` decimal(10,2) DEFAULT '0.00',
  `pay_uid` int(10) DEFAULT NULL,
  `pay_openid` varchar(100) DEFAULT NULL,
  `pay_nickname` varchar(100) DEFAULT NULL,
  `pay_avatar` varchar(200) DEFAULT NULL,
  `pay_time` int(11) DEFAULT '0',
  `ask_type` varchar(10) DEFAULT NULL COMMENT '私密还是公开',
  `ask_content` text,
  `payto_uid` int(10) DEFAULT NULL,
  `pay_type` varchar(10) DEFAULT NULL COMMENT '提问还是偷听',
  `pay_status` tinyint(3) DEFAULT NULL,
  `ask_id` int(10) DEFAULT NULL COMMENT '偷听时指向父id',
  `is_answer` tinyint(3) DEFAULT '0',
  `answer_time` int(11) DEFAULT NULL COMMENT '回答时间',
  `transaction_id` varchar(100) DEFAULT NULL COMMENT '交易流水号',
  `out_trade_no` varchar(100) DEFAULT NULL COMMENT '订单号',
  `avg_score` decimal(10,2) DEFAULT '0.00',
  `listen_num` int(10) DEFAULT '0',
  `look_num` int(10) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `refund_time` int(11) DEFAULT NULL COMMENT '退款时间-只有退款时才有用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_answer` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `ask_id` int(10) DEFAULT NULL,
  `answer_type` varchar(10) DEFAULT NULL COMMENT 'voice,image,text',
  `answer_content` varchar(500) DEFAULT NULL,
  `answer_content_down` varchar(1000) DEFAULT NULL,
  `answer_uid` int(10) DEFAULT NULL,
  `time_last` int(10) DEFAULT NULL,
  `down_time` int(11) DEFAULT NULL COMMENT '文件上传七牛时间',
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_banner` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_follow` (
  `id` int(10) NOT NULL,
  `uid` int(10) DEFAULT NULL,
  `follow_uid` int(10) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_score` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `ask_id` int(10) DEFAULT NULL COMMENT '偷听时指向父id',
  `uid` int(11) DEFAULT '0',
  `score` int(10) DEFAULT NULL COMMENT '交易流水号',
  `create_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_share` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `share_title` varchar(500) DEFAULT NULL,
  `share_desc` varchar(1000) DEFAULT NULL,
  `share_img` varchar(200) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_summary` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `max_id` int(10) DEFAULT NULL COMMENT '上次汇总的最大id',
  `pay_amount` decimal(10,2) DEFAULT '0.00' COMMENT '原始汇总金额',
  `last_amount` decimal(10,2) DEFAULT '0.00' COMMENT '最终汇总金额(扣除点数)',
  `pay_count` int(10) DEFAULT '0' COMMENT '数量',
  `payto_uid` int(10) DEFAULT NULL COMMENT '数量',
  `summary_type` tinyint(3) DEFAULT '0' COMMENT '1-付费回答,2-回答者旁听收入,3-提问者旁听收入',
  `create_time` int(11) DEFAULT '0',
  `batch_num` varchar(100) DEFAULT NULL COMMENT '结算批次号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_summary_last` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `pay_amount` decimal(10,2) DEFAULT '0.00' COMMENT '原始汇总金额',
  `last_amount` decimal(10,2) DEFAULT '0.00' COMMENT '最终汇总金额(扣除点数)',
  `payto_uid` int(10) DEFAULT NULL COMMENT '数量',
  `status` tinyint(3) DEFAULT '1' COMMENT '1-处理中,2-已打款',
  `create_time` int(11) DEFAULT '0',
  `pay_time` int(11) DEFAULT '0' COMMENT '结算时间',
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '结算号',
  `batch_num` varchar(100) DEFAULT NULL COMMENT '批次号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_ask_tags` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `tag_name` varchar(50) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_chat_users` (
  `id` int(11) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL,
  `nickname` varchar(80) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `unionid` varchar(100) DEFAULT NULL,
  `sex` tinyint(3) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL COMMENT '电话号码',
  `real_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `subscribe_time` int(11) DEFAULT NULL,
  `is_openask` tinyint(3) DEFAULT '0' COMMENT '0-不开,1-开启,-1-被禁用',
  `user_title` varchar(100) DEFAULT NULL,
  `user_desc` varchar(1000) DEFAULT NULL,
  `pay_money` decimal(10,2) DEFAULT '0.00',
  `is_recommend` tinyint(4) DEFAULT NULL COMMENT '0-正常,1-推荐',
  `answer_num` int(10) DEFAULT '0',
  `follow_num` int(10) DEFAULT '0',
  `tags` varchar(1000) DEFAULT NULL COMMENT '标签',
  `create_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

EOF;
pdo_run($sql);
