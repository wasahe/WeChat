<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/14
 * Time: 15:44
 */
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorec').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorec_slide').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_proreccate').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorecread').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorecuser').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorectemp').";");
pdo_query("DROP TABLE IF EXISTS".tablename('dg_prorectags').";");