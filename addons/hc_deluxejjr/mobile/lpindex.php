<?php

$loupan = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `status` = 1 ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
include $this->template('lpindex');