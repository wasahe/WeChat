<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class thumbup
{
    public $table = 'yukiho_zvoice_thumbup';

    public function __construct()
    {
        $this->install();
    }

    public function getall($params = array()){
        global $_W,$_GPC;
        $params['uniacid'] = $_W['uniacid'];
        $list = pdo_getall($this->table,$params);
        return $list;
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
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
    public function getSpecInfo($type,$itemid){
        global $_W,$_GPC;
		$res = array();
		$params = array();
        $params['uniacid'] = $_W['uniacid'];
        $params['type'] = $type;
        $params['itemid'] = $itemid;
        $where = " ";
        $ss = array();
        foreach ($params as $key=>$par){
            $where .= " AND {$key} = :{$key}";
            $ss[':'.$key]=$par;
        }
		
		// 获取点击的数量
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE 1 {$where}";
        $res['nums'] = pdo_fetchcolumn($sql,$params);
		
		// 判断是否点击过
		$params['openid'] = $_W['openid'];
        $res['item'] = pdo_get($this->table,$params);
		
		return $res;
    }
    public function getTotal($task_id){
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE task_id = :task_id";
        $params = array(':task_id'=>$task_id);
        $count = pdo_fetchcolumn($sql,$params);
        if(empty($count)){
            $count = 0;
        }
        return $count;
    }
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `openid` varchar(64) DEFAULT '',
              `create_time` int(11) DEFAULT '0',
              `itemid` int(11) DEFAULT '0',
              `type` varchar(64) DEFAULT '',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
    }
}