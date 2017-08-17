<?php

/**
 * used: 
 * User: yukiho_zvoice
 * 
 */
class themes_answer
{
    public $table = 'yukiho_zvoice_themes_answer';

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
        $p = trim($_GPC['themes_id']);
        if(!empty($p)){
            $where .= " AND themes_id = :themes_id";
            $params[':themes_id'] = $p;
        }
        unset($p);
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
            $themes = M('themes')->getInfo($data['themes_id']);
            $themes['answer_num'] = intval($themes['answer_num']) + 1;
            M('themes')->update($themes);
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
    public function check($themes_id,$openid){
        $item = pdo_get($this->table,array('openid'=>$openid,'themes_id'=>$themes_id));
        return $item;
    }
    public function deleteOpenid($themes_id,$openid){
        $item = pdo_delete($this->table,array('openid'=>$openid,'themes_id'=>$themes_id));
        return $item;
    }
    public function getTotal($themes_id){
        $sql = "SELECT COUNT(*) FROM ".tablename($this->table)." WHERE themes_id = :themes_id";
        $params = array(':themes_id'=>$themes_id);
        return pdo_fetchcolumn($sql,$params);
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
        if(!pdo_fieldexists($this->table,'create_time')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `create_time` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'themes_id')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `themes_id` int(11) DEFAULT '0'");
        }
        if(!pdo_fieldexists($this->table,'openid')){
            pdo_query("ALTER TABLE ".tablename($this->table)." ADD COLUMN `openid` varchar(64) DEFAULT ''");
        }
    }
}