<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_aj_webjump`;
DROP TABLE IF EXISTS `ims_aj_webjump_player`;
EOF;
pdo_run($sql);