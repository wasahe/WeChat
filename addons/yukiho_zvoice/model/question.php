<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class question
{
    public $table = 'yukiho_zvoice_question';

    public function __construct()
    {
        $this->install();
    }
	
	public function getPayCheck(){
        global $_W,$_GPC;
		$res = array();
		$pro = M('setting')->getSetting('pro');
		if($pro['openPointPay']=='1'){
			//&& floatval($_W['member']['credit1'])>=floatval(floatval($c)*floatval($pro['pointRatio']))){
			return floatval($pro['pointRatio']);
		}else{ 
			return 0;
		}
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
        $p = trim($_GPC['category_id']);
        if(!empty($p)){
            $where .= " AND category_id = :category_id";
            $params[':category_id'] = $p;
        }
        $p = trim($_GPC['status']);
        if(!empty($p) || $p=='0'){
            $where .= " AND status = :status";
            $params[':status'] = $p;
        }
        $p = trim($_GPC['istask']);
        if(!empty($p) || $p=='0'){
            $where .= " AND istask = :istask";
            $params[':istask'] = $p;
        }
        unset($p);
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY {$orderby} limit ".(($page-1)*$psize).",".$psize;
        $result = array();
        $result['list'] = pdo_fetchall($sql,$params);
		//自动开启限时免费
		$setting = M('setting')->getSetting('pro');
		if(floatval($setting['openFree'])>0){
			foreach ($result['list'] as &$li) {
				if($li['istask']!='1' && (time()-$li['create_time'])<=(floatval($setting['openFree'])*3600)){
					$li['isfree'] = '1';
				}
			}
		}
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }

    public function getMyQuestions($page,$openid){
        global $_W;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a "
			." LEFT JOIN ".tablename('yukiho_zvoice_answer')." b "
			." on b.question_id = a.id "
			." where a.open='1' and b.uniacid=:uniacid and a.openid!=:openid AND b.openid = :openid GROUP BY a.id order by create_time desc limit ".(($page-1)*5).",5";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        return pdo_fetchall($sql,$params);
    }
	
    public function getscore($openid){
        global $_W,$_GPC;
        $params['uniacid'] = $_W['uniacid'];
        $params['to_openid'] = $openid;
        $where .= " AND uniacid = :uniacid AND to_openid = :to_openid AND score>0";
        $sql = "SELECT avg(score) FROM ".tablename($this->table)." WHERE 1 {$where}";
        return pdo_fetchcolumn($sql,$params);
    }

    public function getFeedList($page,$params,$psize = 10,$set){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
        $total = 0;
        $params['uniacid'] = $_W['uniacid'];
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a"
			." LEFT JOIN ".tablename('yukiho_zvoice_follow')." b"
			." on a.".$set['from']." = b.".$set['to']
			." where a.`istask`=0 and a.`open`=1 and a.`status`=2 and a.uniacid=:uniacid "
			." and b.".$set['follow']." = '".$_W['openid']."'"
			." ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
		$result = array();
        $result['list'] = pdo_fetchall($sql,$params);
		//自动开启限时免费
		$setting = M('setting')->getSetting('pro');
		if($_SESSION['pro']=='1' && intval($setting['openFree'])>0){
			foreach ($result['list'] as &$li) {
				if($li['istask']!='1' && (time()-$item['create_time'])<=(intval($setting['openFree'])*3600)){
					$li['isfree'] = '1';
				}
			}
		}
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $total = pdo_fetchcolumn($sql,$params);

        $result['pager'] = pagination($total, $page, $psize);
        if(empty($result)){
            return array();
        }else{
            return $result;
        }
    }

    public function getRandomList($id,$num){
        global $_W,$_GPC;
        $where .= " AND uniacid = :uniacid";
        if(!empty($p)){
            $where .= " AND category_id = :category_id";
            $params[':category_id'] = trim($_GPC['category_id']);
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE id<>".$id." AND open=1 and status='2' ORDER BY RAND() LIMIT ".$num;
		
		//"SELECT * FROM ".tablename($this->table)." AS t1 JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM ".tablename($this->table).")) AS id) AS t2 "
		//	."WHERE t1.id >= t2.id ".$where." ORDER BY t1.id ASC LIMIT 5";
		//SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time DESC limit ".(($page-1)*$psize).",".$psize;
		return pdo_fetchall($sql);
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
    public function getInfoSpec($id){
        global $_W;
        $item = pdo_get($this->table,array('id'=>$id));
		//自动开启限时免费
		$setting = M('setting')->getSetting('pro');
		if($item['istask']!='1' && !empty($setting['openFree']) && intval($setting['openFree'])>0 
			&& (time()-$item['create_time'])<=(intval($setting['openFree'])*3600)){
			$item['isfree'] = '1';
		}
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
	
    public function getrand($category_id){
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE category_id =:category_id ORDER BY rand() limit 1";
        $params = array('category_id'=>$category_id);
        $item = pdo_fetch($sql,$params);
        return $item;
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
    public function getFreeTotal(){
        global $_W;
        $where = " AND isfree = :isfree AND free_end_time > :free_end_time AND status = :status";
        $params = array(':isfree'=>1,':free_end_time'=>time(),':status'=>2);
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE uniacid = :uniacid {$where}";
        $params[':uniacid'] = $_W['uniacid'];
        $count = pdo_fetchcolumn($sql,$params);
        if(empty($count)){
            $count = 0;
        }
        return $count;
    }
    public function getTotal($openid){
        global $_W;
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE openid = :openid AND uniacid = :uniacid ";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        $count = pdo_fetchcolumn($sql,$params);
        return $count;
    }
    public function install(){
		if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`uniacid` int(11) DEFAULT '0',
				`create_time` int(11) DEFAULT '0',
				`title` varchar(320) DEFAULT '',
				`category_id` int(11) DEFAULT '0',
				`openid` varchar(64) DEFAULT '',
				`credit` decimal(10,2) DEFAULT '0.00',
				`listen_num` int(11) DEFAULT '0',
				`good_num` int(11) DEFAULT '0',
				`open` tinyint(2) DEFAULT '0',
				`voice_id` varchar(320) DEFAULT '',
				`to_openid` varchar(64) DEFAULT '',
				`status` tinyint(2) DEFAULT '0',
				`score` tinyint(2) DEFAULT '0',
				`feedback` varchar(320) DEFAULT '',
				`isfree` tinyint(2) DEFAULT '0',
				`timelong` int(11) DEFAULT '0',
				`hash` varchar(320) DEFAULT '',
				`key` varchar(320) DEFAULT '',
				`isweixin` tinyint(2) DEFAULT '0',
				`images` varchar(1000) DEFAULT '',
				`sn` varchar(64) DEFAULT '',
				`isrecommend` tinyint(2) DEFAULT '0',
				`src` varchar(320) DEFAULT '',
				`istask` tinyint(2) DEFAULT '0',
				`isanonymous` tinyint(2) DEFAULT '0',
				PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
    }
}