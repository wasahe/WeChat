<?php

function repair(){
	if(!pdo_fieldexists(xm_gohome_base,  title)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_base)." ADD `title` nvarchar(50) default '幸福到家';");
	}
	
	if(!pdo_fieldexists(xm_gohome_base,  key_info)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_base)." ADD `key_info` nvarchar(100) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_base,  xianzhi)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_base)." ADD `xianzhi` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_base,  version)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_base)." ADD `version` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_servetype, icon_pc)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `icon_pc` nvarchar(100) default null;");
	}
	
	
	if(!pdo_fieldexists(xm_gohome_servetype,  price)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `price` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00;");
	}
	
	if(!pdo_fieldexists(xm_gohome_servetype, otmpmsg_id)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `otmpmsg_id` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_servetype, qtmpmsg_id)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `qtmpmsg_id` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_servetype, xtmpmsg_id)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `xtmpmsg_id` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_paylog,  remark)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_paylog)." ADD `remark` nvarchar(3000) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_paylog,  state)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_paylog)." ADD `state` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_paylog,  suanstate)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_paylog)." ADD `suanstate` int(11) default 0;");
	}
	
	if(!pdo_fieldexists(xm_gohome_paylog,  fastate)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_paylog)." ADD `fastate` int(11) default 0;");
	}
	
	//服务人员表【打印机状态】
	if(!pdo_fieldexists(xm_gohome_staff,  print_state)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `print_state` int(11) default 0;");
	}
	
	//服务人员表【开户银行】
	if(!pdo_fieldexists(xm_gohome_staff,  bank)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `bank` nvarchar(300) default null;");
	}
	
	//服务人员表【银行卡号】
	if(!pdo_fieldexists(xm_gohome_staff,  bank_num)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `bank_num` nvarchar(300) default null;");
	}
	
	//服务人员表【支付宝账号】
	if(!pdo_fieldexists(xm_gohome_staff,  alipay)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `alipay` nvarchar(300) default null;");
	}
	
	//服务人员表【保证金等级】
	if(!pdo_fieldexists(xm_gohome_staff,  grade_id)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `grade_id` int(11) default 0;");
	}
	
	//服务人员表【保证金金额】
	if(!pdo_fieldexists(xm_gohome_staff,  grade_money)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_staff)." ADD `grade_money` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00;");
	}
	
	if(!pdo_fieldexists(xm_gohome_order,  lat)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_order)." ADD `lat` nvarchar(100) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_order,  lng)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_order)." ADD `lng` nvarchar(100) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_tixianlog,  yumoney)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_tixianlog)." ADD `yumoney` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00;");
	}
	
	if(!pdo_fieldexists(xm_gohome_tixianlog,  famoney)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_tixianlog)." ADD `famoney` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00;");
	}
	
	if(!pdo_fieldexists(xm_gohome_tixianlog,  staff_id)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_tixianlog)." ADD `staff_id` int(11) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_companygetmoney, type)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_companygetmoney)." ADD `type` int(11) default null;");
	}
	
	if(!pdo_fieldexists(xm_gohome_companygetmoney, way)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_companygetmoney)." ADD `way` int(11) default null;");
	}
	
	//项目【抢单基础金额】
	if(!pdo_fieldexists(xm_gohome_servetype, basemoney)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_servetype)." ADD `basemoney` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00;");
	}
	
	//给xm_gohome_grade添加delstate字段
	if(!pdo_fieldexists(xm_gohome_grade, delstate)) {
		pdo_query("ALTER TABLE ".tablename(xm_gohome_grade)." ADD `delstate` int(11) default 1;");
	}
	
	
	if(!pdo_tableexists(xm_gohome_blacklist)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_blacklist)." (
	`id`  int(11) NOT NULL AUTO_INCREMENT ,
	`openid`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`state`  int(11) NULL DEFAULT NULL ,
	PRIMARY KEY (`id`)
	)
	ENGINE=MyISAM
	DEFAULT CHARACTER SET=utf8");
	}
	
	
	if(!pdo_tableexists(xm_gohome_message)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_message)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,platform nvarchar(300) DEFAULT NULL,plat_name nvarchar(300) DEFAULT NULL,plat_pwd nvarchar(100) DEFAULT NULL,qianming nvarchar(500) DEFAULT NULL,message1 int(11) DEFAULT 0,message1_content text DEFAULT NULL,message2 int(11) DEFAULT 0,message2_content text DEFAULT NULL,message3 int(11) DEFAULT 0,message3_content text DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	
	if(!pdo_tableexists(xm_gohome_print)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_print)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,staff_id int(11) DEFAULT NULL,printer_sn nvarchar(100) DEFAULT NULL,key_info nvarchar(300) DEFAULT NULL,number int(11) DEFAULT NULL,xiaopiao text DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	
	if(!pdo_tableexists(xm_gohome_pic)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_pic)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,pic nvarchar(100) DEFAULT NULL,random int(11) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	
	if(!pdo_tableexists(xm_gohome_temp)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_temp)." (
	`id`  int(11) NOT NULL AUTO_INCREMENT ,
	`weid`  int(11) NULL DEFAULT NULL ,
	`temp_name`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`temp_token`  varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`bgcolor`  varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`bgimage`  varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`jsgs`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '计算公式' ,
	`html`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`cid`  int(11) NULL DEFAULT NULL ,
	`delstate`  int(11) NULL DEFAULT 1 ,
	`updatetime`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	PRIMARY KEY (`id`)
	)
	ENGINE=MyISAM
	DEFAULT CHARACTER SET=utf8");
	}
	
	
	if(!pdo_tableexists(xm_gohome_tempvalue)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_tempvalue)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,temp_id int(11) DEFAULT NULL,temp_token varchar(300) DEFAULT NULL,input_type varchar(500) DEFAULT NULL,input_laber varchar(500) DEFAULT NULL,input_name varchar(1000) DEFAULT NULL,input_value varchar(1000) DEFAULT NULL,value_name varchar(1000) DEFAULT NULL,input_default varchar(1000) DEFAULT NULL,remark varchar(1000) DEFAULT NULL,prompts varchar(1000) DEFAULT NULL,top int(11) DEFAULT '0',PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	if(!pdo_tableexists(xm_gohome_tixianlog)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_tixianlog)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,openid nvarchar(100) DEFAULT NULL,money DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,yumoney DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,famoney DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,staff_id int(11) DEFAULT NULL,state int(11) DEFAULT 0,start nvarchar(100) DEFAULT NULL,end nvarchar(100) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	if(!pdo_tableexists(xm_gohome_moneylog)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_moneylog)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,money1 DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,money2 DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,remark text DEFAULT NULL,username nvarchar(100) DEFAULT NULL,tid int(11) DEFAULT NULL,openid nvarchar(100) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	if(!pdo_tableexists(xm_gohome_falog)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_falog)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,openid nvarchar(100) DEFAULT NULL,money DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,staff_id int(11) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	if(!pdo_tableexists(xm_gohome_running)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_running)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,type int(11) DEFAULT 0,type_id nvarchar(100) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	//模板消息表
	if(!pdo_tableexists(xm_gohome_tempmessage)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_tempmessage)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,message_name nvarchar(300) DEFAULT NULL,msg_id nvarchar(300) DEFAULT NULL,color_title nvarchar(100) DEFAULT NULL,color_content nvarchar(100) DEFAULT NULL,dataname nvarchar(1000) DEFAULT NULL,datavalue text DEFAULT NULL,msg_content text DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	//默认模板消息表
	if(!pdo_tableexists(xm_gohome_tempmessagedefault)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_tempmessagedefault)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,`stmpmsg_id` int(11) DEFAULT NULL,`otmpmsg_id` int(11) DEFAULT NULL,`qtmpmsg_id` int(11) DEFAULT NULL,`xtmpmsg_id` int(11) DEFAULT NULL,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	
	//保证金等级表
	if(!pdo_tableexists(xm_gohome_grade)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_grade)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,grade_name nvarchar(300) DEFAULT NULL,icon nvarchar(100) DEFAULT NULL,grade_money DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,remark text DEFAULT NULL,delstate int(11) DEFAULT 1,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
	
	//用户充值表
	if(!pdo_tableexists(xm_gohome_userrechargelog)) {
		pdo_query("CREATE TABLE ".tablename(xm_gohome_userrechargelog)." (id int(11) NOT NULL AUTO_INCREMENT,weid int(11) NOT NULL,openid nvarchar(100) DEFAULT NULL,type int(11) DEFAULT NULL,money DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,addtime timestamp NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}
}