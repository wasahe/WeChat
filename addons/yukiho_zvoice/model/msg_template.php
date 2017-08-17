<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class msg_template
{
    public $table = 'yukiho_zvoice_msg_template';

    public function __construct(){
        $this->install();
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getList($page,$where ="",$params = array(),$psize = 10,$orderby='create_time DESC'){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $where .= " AND uniacid = :uniacid";
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY {$orderby} limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }

    public function getMyspeechs($page,$openid){
        global $_W;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a "
			." LEFT JOIN ".tablename('yukiho_zvoice_answer')." b "
			." on b.speech_id = a.id "
			." where a.open='1' and b.uniacid=:uniacid and a.openid!=:openid AND b.openid = :openid GROUP BY a.id order by create_time desc limit ".(($page-1)*5).",5";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        return pdo_fetchall($sql,$params);
    }
	
    public function update($data){
        global $_W;
        $data['uniacid'] = $_W['uniacid'];
        if(empty($data['id'])){
            pdo_insert($this->table,$data);
            $data['id'] = pdo_insertid();
        }else{
            // 更新
            pdo_update($this->table,$data,array('uniacid'=>$_W['uniacid'],'id'=>$data['id']));
        }
        return $data;
    }
	
    public function getInfo($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
        return $item;
    }

    public function getall($params = array()){
        global $_W,$_GPC;
		
        $params['uniacid'] = $_W['uniacid'];
        $where = " ";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC";
        return pdo_fetchall($sql,$ss);
    }
	
    public function getTotal($openid){
        global $_W;
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE openid = :openid AND uniacid = :uniacid ";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        $count = pdo_fetchcolumn($sql,$params);
        return $count;
    }
	
    public function install(){
		//pdo_query('DROP TABLE '.tablename($this->table));
		if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `create_time` int(11) DEFAULT '0',
              `title` varchar(320) DEFAULT '',
              `category_id` int(11) DEFAULT '0',
              `openid` varchar(64) DEFAULT '',
              `credit` decimal(10,1) DEFAULT '0.0',
              `listen_num` int(11) DEFAULT '0',
              `good_num` int(11) DEFAULT '0',
              `status` tinyint(2) DEFAULT '0',
              `join_num` int(8) DEFAULT '0',
              `last_reply` int(11) DEFAULT '0',
              `isfree` tinyint(2) DEFAULT '0',
              `description` varchar(2500) DEFAULT '',
              `cover` varchar(250) DEFAULT '',
              `sn` varchar(64) DEFAULT '',
              `isrecommend` tinyint(2) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
    }
}