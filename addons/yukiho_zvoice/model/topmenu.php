<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class topmenu
{
    public $table = 'yukiho_zvoice_topmenu';

    public function __construct()
    {
        $this->install();
    }

    public function getDefaultMenu($page){
        global $_W;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE page=:page ORDER BY displayorder DESC limit 1";
        $params = array('page'=>$page);
        $item = pdo_fetch($sql,$params);
        return $item;
    }
	
    public function getall($where=" ", $params = array(), $orderby='displayorder DESC'){
        global $_W,$_GPC;
		
        $params['uniacid'] = $_W['uniacid'];
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY {$orderby}";
        return pdo_fetchall($sql,$ss);
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where =""){
        global $_W;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $params = array(':uniacid'=>$_W['uniacid']);
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }
    public function update($data){
        global $_W;
        $data['uniacid'] = $_W['uniacid'];
        if(empty($data['id'])){
            pdo_insert($this->table,$data);
            $data['id'] = pdo_insertid();
        }else{
            //¸üÐÂ
            pdo_update($this->table,$data,array('uniacid'=>$_W['uniacid'],'id'=>$data['id']));
        }
        return $data;
    }
    public function getInfo($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
        return $item;
    }
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `create_time` int(11) DEFAULT '0',
              `title` varchar(32) DEFAULT '',
              `type` varchar(32) DEFAULT '0',
              `cateid` int(4) DEFAULT '0',
              `link` varchar(320) DEFAULT '',
              `displayorder` int(11) DEFAULT '0',
              `page` varchar(32) DEFAULT '',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'ismain')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `ismain` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'onlymain')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `onlymain` tinyint(2) DEFAULT '0'");
        }
    }
}