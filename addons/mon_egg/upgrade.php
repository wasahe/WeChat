<?php

if(!pdo_fieldexists('mon_egg', 'exchangeEnable')) {
	pdo_query("ALTER TABLE ".tablename('mon_egg')." ADD   `exchangeEnable` int(1) DEFAULT NULL ;");
}

