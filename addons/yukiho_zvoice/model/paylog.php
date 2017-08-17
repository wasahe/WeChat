<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class paylog
{
    public $table = 'yukiho_zvoice_paylog';

    public function __construct()
    {
        $this->install();
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

    public function delete($params = array()){
        if(empty($params)){
            return '';
        }
        pdo_delete($this->table,$params);
    }

    public function getList($page,$where ="",$params = array()){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $psize = 20;
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $where .= " AND uniacid = :uniacid";

        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
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
    public function membertotalcredit($params = array()){
        global $_W,$_GPC;
        $return = array(0.00,0.00,0.00,0.00,0.00,0.00,0.00);
        $return['ktx'] = 0.00;
        $return['ytx'] = 0.00;
        $ss = array();
		$params['uniacid'] = $_W['uniacid'];
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
		
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE credit>0 AND status>0 {$where}";
        $list = pdo_fetchall($sql,$ss);
		foreach ($list as &$li) {
			$return[$li['type']] += $li['credit'];
			if($li['status']==1){
				$return['ktx'] += $li['credit'];
			}else if($li['status']==2){
				$return['ytx'] += $li['credit'];
			}
			$return[0] += $li['credit'];
		}
		return $return;
	}
    public function totalcredit(){
        global $_W,$_GPC;
        $return = array();
        $return['all'] = array();
        $params = array(':uniacid'=>$_W['uniacid']);
        $where = " AND status > 0";
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
        $sql = "SELECT SUM(credit) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >=:star_time AND `create_time` < :end_time {$where}";
    
        $return['week']['fee'] = pdo_fetchcolumn($sql,$params);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid AND `create_time` >:star_time AND `create_time` < :end_time {$where}";
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
    public function getSn($sn){
        global $_W;
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE sn = :sn AND uniacid = :uniacid";
        $params = array(':sn'=>$sn,':uniacid'=>$_W['uniacid']);
        $item = pdo_fetch($sql,$params);
        return $item;
    }
    public function updateSn($oldSn, $newSn){
        pdo_update($this->table,array('sn'=>$newSn),array('sn'=>$oldSn));
    }
	
    public function finish($sn){
        global $_W;
        pdo_update($this->table,array('status'=>1),array('uniacid'=>$_W['uniacid'],'sn'=>$sn));
    }
	
    public function insert($credit,$to_openid,$sn,$type,$question_id,$status=0,$openid){
        global $_W;
		if(floatval($credit)>0 && !empty($to_openid)){
			$paylog['credit'] = $credit;
			$paylog['uniacid'] = $_W['uniacid'];
			$paylog['openid'] = isset($openid) ? $openid : $_W['openid'] ;
			$paylog['to_openid'] = $to_openid;
			$paylog['sn'] = $sn;
			$paylog['status'] = $status;
			$paylog['question_id'] = intval($question_id);
			$paylog['type'] = $type;
			$paylog['create_time'] = time();
			pdo_insert($this->table,$paylog);
		}
    }
	
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `create_time` int(11) DEFAULT '0',
              `type` tinyint(2) DEFAULT '0',
              `credit` decimal(10,2) DEFAULT '0.00',
              `sn` varchar(64) DEFAULT '',
              `openid` varchar(64) DEFAULT '',
              `to_openid` varchar(64) DEFAULT '',
			  `question_id` int(11) DEFAULT '0',
			  `status` tinyint(2) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'mode')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `mode` varchar(64) DEFAULT 'admin'");
        }
    }
}