<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class speech_item
{
    public $table = 'yukiho_zvoice_speech_item';

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

    public function getTimeCount($id){
        global $_W,$_GPC;
		
        $sql = "SELECT SUM(timelong) FROM ".tablename($this->table)
			." WHERE uniacid = :uniacid AND `speech_id`=:speech_id ";
        $params[':uniacid'] = $_W['uniacid'];
        $params[':speech_id'] = $id;
    
        $count = pdo_fetchcolumn($sql,$params);
        return intval($count/60)+1;
    }
	
    public function getMyspeech_items($page,$openid){
        global $_W;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a "
			." LEFT JOIN ".tablename('yukiho_zvoice_answer')." b "
			." on b.speech_item_id = a.id "
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
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY dsporder asc";
        return pdo_fetchall($sql,$ss);
    }
	
	public function hasNextItem($speech_id, $dsporder, $type='>', $st='dsporder asc'){
        global $_W,$_GPC;
		$where = " AND istitle !=1 ";
        $params = array(':uniacid'=>$_W['uniacid']);
        $where .= " AND speech_id = :speech_id";
        $params[':speech_id'] = $speech_id;
        $where .= " AND dsporder ".$type." :dsporder ";
        $params[':dsporder'] = $dsporder;
		
		$sql = "SELECT * FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where} ORDER BY ".$st;
        return pdo_fetch($sql,$params);
	}

    public function totalcredit(){
        global $_W,$_GPC;
        $return = array();
        $return['all'] = array();
        $params = array(':uniacid'=>$_W['uniacid']);
        $where = "";
        $p = trim($_GPC['start_time']);
        if(!empty($p)){
            $where .= " AND create_time >= :start_time";
            $params[':start_time'] = strtotime($p);
        }
        unset($p);
        $p = trim($_GPC['end_time']);
        if(!empty($p)){
            $where .= " AND create_time <= :end_time";
            $params[':end_time'] = strtotime($p);
        }
        unset($p);
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $return['all']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $return['all']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['all']['fee'])){
            $return['all']['fee'] = 0.00;
        }
        if(empty($return['all']['sum'])){
            $return['all']['sum'] = 0;
        }
        $start_time = strtotime(date('Y-m-d',time()));
        $end_time = time();
    
        $return['day'] = array();
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <=:end_time {$where}";
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
    
        $return['day']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <=:end_time {$where}";
        $return['day']['sum'] = pdo_fetchcolumn($sql,$params);
    
        if(empty($return['day']['fee'])){
            $return['day']['fee'] = 0.00;
        }
        if(empty($return['day']['sum'])){
            $return['day']['sum'] = 0;
        }
        $start_time = strtotime(date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y"))));
        $end_time = strtotime(date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))));

        $return['week'] = array();
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <= :end_time {$where}";
    
        $return['week']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` <= :end_time {$where}";
        $return['week']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['week']['fee'])){
            $return['week']['fee'] = 0.00;
        }
        if(empty($return['week']['sum'])){
            $return['week']['sum'] = 0;
        }
        $start_time = strtotime(date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y"))));
        $end_time = strtotime(date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y"))));
        $return['month'] = array();
        $params[':star_time'] = $start_time;
        $params[':end_time'] = $end_time;
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND create_time >=:star_time AND create_time <=:end_time {$where}";
        $return['month']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND create_time >=:star_time AND create_time <=:end_time {$where}";
        $return['month']['sum'] = pdo_fetchcolumn($sql,$params);
        if(empty($return['month']['fee'])){
            $return['month']['fee'] = 0.00;
        }
        if(empty($return['month']['sum'])){
            $return['month']['sum'] = 0;
        }
        return $return;
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
              `speech_id` int(11) DEFAULT '0',
              `timelong` int(11) DEFAULT '0',
              `src` varchar(320) DEFAULT '',
              `istitle` tinyint(2) DEFAULT '0',
              `listen_num` int(11) DEFAULT '0',
              `good_num` int(11) DEFAULT '0',
              `dsporder` int(11) DEFAULT '0',
              `status` tinyint(2) DEFAULT '0',
              `isfree` tinyint(2) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
    }
}