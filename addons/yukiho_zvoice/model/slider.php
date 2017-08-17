<?php
/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class slider
{
    public $table = 'yukiho_zvoice_slider';

    public function __construct()
    {
        $this->install();
    }
	
    public function getall($params = array()){
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
        $sql = "SELECT * FROM ".tablename($this->table)." WHERE 1 {$where} ORDER BY dsporder DESC ";
        $list = pdo_fetchall($sql,$ss);
        return $list;
    }

    public function delete($id){
        if(empty($id)){
            return '';
        }
        pdo_delete($this->table,array('id'=>$id));
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
	  
    public function install(){
        if(!pdo_tableexists($this->table)){
            $sql = "CREATE TABLE ".tablename($this->table)." (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uniacid` int(11) DEFAULT '0',
              `title` varchar(255) DEFAULT '',
              `image` varchar(255) DEFAULT '',
              `link` varchar(255) DEFAULT '',
              `status` tinyint(2) DEFAULT '1',
              `dsporder` int(11) DEFAULT '0',
              `create_time` int(11) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            pdo_query($sql);
        }
    }
}