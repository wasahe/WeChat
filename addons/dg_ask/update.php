<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_chat_ask` (
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
");
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_money')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_money` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_uid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_openid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_openid` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_nickname')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_nickname` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_avatar')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_avatar` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_time` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'ask_type')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `ask_type` varchar(10)    COMMENT '私密还是公开';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'ask_content')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `ask_content` text    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'payto_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `payto_uid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_type')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_type` varchar(10)    COMMENT '提问还是偷听';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'pay_status')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `pay_status` tinyint(3)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'ask_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `ask_id` int(10)    COMMENT '偷听时指向父id';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'is_answer')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `is_answer` tinyint(3)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'answer_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `answer_time` int(11)    COMMENT '回答时间';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'transaction_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `transaction_id` varchar(100)    COMMENT '交易流水号';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'out_trade_no')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `out_trade_no` varchar(100)    COMMENT '订单号';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'avg_score')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `avg_score` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'listen_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `listen_num` int(10)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'look_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `look_num` int(10)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `create_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask')) {
    if (!pdo_fieldexists('chat_ask', 'refund_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask') . " ADD `refund_time` int(11)    COMMENT '退款时间-只有退款时才有用';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'ask_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `ask_id` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'answer_type')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `answer_type` varchar(10)    COMMENT 'voice,image,text';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'answer_content')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `answer_content` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'answer_content_down')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `answer_content_down` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'answer_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `answer_uid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'time_last')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `time_last` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'down_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `down_time` int(11)    COMMENT '文件上传七牛时间';");
    }
}
if (pdo_tableexists('chat_ask_answer')) {
    if (!pdo_fieldexists('chat_ask_answer', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_answer') . " ADD `create_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'bannername')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `bannername` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'link')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `link` varchar(255)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'thumb')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `thumb` varchar(255)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'displayorder')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `displayorder` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_banner')) {
    if (!pdo_fieldexists('chat_ask_banner', 'enabled')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_banner') . " ADD `enabled` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_follow')) {
    if (!pdo_fieldexists('chat_ask_follow', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_follow') . " ADD `id` int(10) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_follow')) {
    if (!pdo_fieldexists('chat_ask_follow', 'uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_follow') . " ADD `uid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_follow')) {
    if (!pdo_fieldexists('chat_ask_follow', 'follow_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_follow') . " ADD `follow_uid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_follow')) {
    if (!pdo_fieldexists('chat_ask_follow', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_follow') . " ADD `create_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'ask_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `ask_id` int(10)    COMMENT '偷听时指向父id';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `uid` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'score')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `score` int(10)    COMMENT '交易流水号';");
    }
}
if (pdo_tableexists('chat_ask_score')) {
    if (!pdo_fieldexists('chat_ask_score', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_score') . " ADD `create_time` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `id` int(10) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'share_title')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `share_title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'share_desc')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `share_desc` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'share_img')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `share_img` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_share')) {
    if (!pdo_fieldexists('chat_ask_share', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_share') . " ADD `create_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `id` int(10) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'max_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `max_id` int(10)    COMMENT '上次汇总的最大id';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'pay_amount')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `pay_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '原始汇总金额';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'last_amount')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `last_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '最终汇总金额(扣除点数)';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'pay_count')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `pay_count` int(10)   DEFAULT 0 COMMENT '数量';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'payto_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `payto_uid` int(10)    COMMENT '数量';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'summary_type')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `summary_type` tinyint(3)   DEFAULT 0 COMMENT '1-付费回答,2-回答者旁听收入,3-提问者旁听收入';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `create_time` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary')) {
    if (!pdo_fieldexists('chat_ask_summary', 'batch_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary') . " ADD `batch_num` varchar(100)    COMMENT '结算批次号';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `id` int(10) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'pay_amount')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `pay_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '原始汇总金额';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'last_amount')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `last_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '最终汇总金额(扣除点数)';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'payto_uid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `payto_uid` int(10)    COMMENT '数量';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'status')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `status` tinyint(3)   DEFAULT 1 COMMENT '1-处理中,2-已打款';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `create_time` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'pay_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `pay_time` int(11)   DEFAULT 0 COMMENT '结算时间';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'transaction_id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `transaction_id` varchar(200)    COMMENT '结算号';");
    }
}
if (pdo_tableexists('chat_ask_summary_last')) {
    if (!pdo_fieldexists('chat_ask_summary_last', 'batch_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_summary_last') . " ADD `batch_num` varchar(100)    COMMENT '批次号';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'tag_name')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `tag_name` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'displayorder')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `displayorder` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'enabled')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `enabled` int(11)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_ask_tags')) {
    if (!pdo_fieldexists('chat_ask_tags', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_ask_tags') . " ADD `create_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `id` int(11) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `uniacid` int(10)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'openid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `openid` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'nickname')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `nickname` varchar(80)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'avatar')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `avatar` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'province')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `province` varchar(30)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'city')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `city` varchar(30)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'unionid')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `unionid` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'sex')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `sex` tinyint(3)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'mobile')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `mobile` varchar(11)    COMMENT '电话号码';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'real_name')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `real_name` varchar(50)    COMMENT '真实姓名';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'subscribe_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `subscribe_time` int(11)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'is_openask')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `is_openask` tinyint(3)   DEFAULT 0 COMMENT '0-不开,1-开启,-1-被禁用';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'user_title')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `user_title` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'user_desc')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `user_desc` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'pay_money')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `pay_money` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'is_recommend')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `is_recommend` tinyint(4)    COMMENT '0-正常,1-推荐';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'answer_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `answer_num` int(10)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'follow_num')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `follow_num` int(10)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'tags')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `tags` varchar(1000)    COMMENT '标签';");
    }
}
if (pdo_tableexists('chat_users')) {
    if (!pdo_fieldexists('chat_users', 'create_time')) {
        pdo_query('ALTER TABLE ' . tablename('chat_users') . " ADD `create_time` int(11)   DEFAULT 0 COMMENT '';");
    }
}