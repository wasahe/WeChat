<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class quickmenu
{
    public $table = 'yukiho_zvoice_quickmenu';

    public function __construct()
    {
        $this->install();
    }

    public function getall(){
        global $_W;
	    $member = M('member')->getInfo($_W['openid']);
		if(intval($member['status'])<3){
			$member['status'] = 0;
		}
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE (auth=:auth OR auth='9') AND uniacid = :uniacid ORDER BY displayorder DESC ";
        $params = array('auth'=>$member['status'], 'uniacid'=>$_W['uniacid']);
        $list = pdo_fetchall($sql,$params);
        return $list;
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
            //更新
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
        global $_W;
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'create_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `create_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'title')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `title` varchar(32) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'name')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `name` varchar(255) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'icon')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `icon` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'link')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `link` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'displayorder')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `displayorder` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'ido')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `ido` varchar(32) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'auth')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `auth` tinyint(2) DEFAULT '0'");
        }
    }
}