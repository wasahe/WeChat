<?php
/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class answer
{
    public $table = 'yukiho_zvoice_answer';

    public function __construct()
    {
        $this->install();
    }
	
    public function getone($params = array()){
        global $_W,$_GPC;
        ini_set('display_errors', '1');
        error_reporting(E_ALL ^ E_NOTICE);

        $params['uniacid'] = $_W['uniacid'];
        $where = "";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY create_time ASC ";
        $entity = pdo_fetch($sql,$ss);
        return $entity;
    }

    public function getInfoByQid($question_id){
        global $_W;
        $item = pdo_get($this->table,array('question_id'=>$question_id));
        return $item;
    }
	
    public function getall($params = array(),$orderby ="create_time desc"){
        global $_W,$_GPC;
        ini_set('display_errors', '1');
        error_reporting(E_ALL ^ E_NOTICE);

        $params['uniacid'] = $_W['uniacid'];
        $where = "";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY {$orderby} ";
        $list = pdo_fetchall($sql,$ss);
        return $list;
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
    }

    public function getLeftAskTime($question_id){
        global $_W,$_GPC;
        if(empty($question_id)){
            return '';
        }
        $openid = $_W['openid'];
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE question_id=:question_id and openid = :openid AND uniacid = :uniacid ";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid'],':question_id'=>$question_id);
        $count = pdo_fetchcolumn($sql,$params);
		$pro = M('setting')->getSetting('pro');
        $openReask = $pro['openReask'];
		return $openReask-$count;
    }
	
    public function getList($page,$where ="",$params = array(),$psize=10){
        global $_W,$_GPC;
        if(empty($page)){
            $page = 1;
        }
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
	
    public function getAnsTotal($params = array()){
        global $_W;
        $params['uniacid'] = $_W['uniacid'];
        $where = "";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT id FROM ".tablename($this->table)." WHERE 1 {$where} group by question_id";
        $count = pdo_fetchall($sql,$ss);
        return count($count);
    }
	
    public function getTaskRate($openid){
        global $_W;
        $sql = "SELECT a.* FROM ".tablename($this->table)." a "
			." LEFT JOIN ".tablename('yukiho_zvoice_question')." b "
			." on a.question_id = b.id "
			." where b.istask='1' and b.status='2' and b.uniacid=:uniacid and a.openid = :openid";
        $params = array(':openid'=>$openid,':uniacid'=>$_W['uniacid']);
        $list = pdo_fetchall($sql,$params);
		$all = count($list);
		$count = 0;
		foreach ($list as &$item) {
			if($item['ispick']=='1'){
				$count++;
			}
		}
        return $all==0?'0':round(floatval($count/$all*100),2);
    }
	
    public function getTotal($params = array()){
        global $_W;
        $params['uniacid'] = $_W['uniacid'];
        $where = "";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where} ";
        $count = pdo_fetchcolumn($sql,$ss);
        return $count;
    }
	
    public function getVoiceId($voice_id){
        global $_W;
        $item = pdo_get($this->table,array('voice_id'=>$voice_id,'uniacid'=>$_W['uniacid']));
        return $item;
    }
    public function getPersistentId($persistentId){
        global $_W;
        $item = pdo_get($this->table,array('persistentId'=>$persistentId,'uniacid'=>$_W['uniacid']));
        return $item;
    }
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
        if(!pdo_fieldexists($this->table,'weblink')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `weblink` varchar(255) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'contents')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `contents` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'mode')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `mode` tinyint(2) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'status')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `status` tinyint(2) DEFAULT '0'");
        } 
        if(!pdo_fieldexists($this->table,'images')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `images` varchar(1000) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'create_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `create_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'question_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `question_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'voice_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `voice_id` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'timelong')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `timelong` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'src')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `src` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'persistentId')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `persistentId` varchar(320) DEFAULT ''");
        }
        if(!pdo_fieldexists($this->table,'ispick')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `ispick` tinyint(2) DEFAULT '0'");
        }
    }
}