<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_xigua114 extends  discuz_table
{
    /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
    public function __construct()
    {
        $this->_table = 'plugin_xigua114';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function multi_delete($ids)
    {
        if (empty($ids)) {
            return FALSE;
        }
        $ids = dintval($ids, TRUE);

        DB::query("DELETE FROM %t WHERE $this->_pk IN (" . dimplode($ids) . ')', array($this->_table));

        return TRUE;
    }


    public function multi_update_status($ids)
    {
        if (empty($ids)) {
            return FALSE;
        }
        $ids = dintval($ids, TRUE);

        DB::query("UPDATE %t SET status=1 WHERE $this->_pk IN (" . dimplode($ids) . ')', array($this->_table));

        return TRUE;
    }

    public function list_by_pt()
    {
        return DB::fetch_all("SELECT id,company_name,logo,pt FROM %t WHERE pt!='' ORDER BY `displayorder` ASC,id DESC LIMIT 10", array($this->_table));
    }

    public function fetch_all_by_page($start_limit , $lpp, $only_uncheck = 0, $ordercat = 1, $where_string = '', $order_string = ''){
        if($only_uncheck){
            $where = ' WHERE status=0 ';
        }else{
            $where = ' WHERE status=1 ';
        }
        if($where_string){
            $where .= $where_string;
        }
        $order = $ordercat ? '`displayorder` ASC,digest DESC,id DESC,catid DESC' : '`displayorder` ASC,digest DESC,id DESC,catid DESC';
        if($order_string){
            $order = $order_string;
        }

        $result = DB::fetch_all(
            'SELECT * FROM '.DB::table($this->_table)." $where ORDER BY $order" . DB::limit($start_limit, $lpp),
            array(),
            'id'
        );
        return $result;
    }

    public function fetch_all_by_pids_page($pids, $start_limit , $lpp, $extwhere = ''){
        if($pids){
            $result = DB::fetch_all(
                "SELECT * FROM %t  WHERE catid IN(%n) AND status=1 $extwhere ORDER BY `displayorder` ASC,digest DESC,id DESC,catid DESC " . DB::limit($start_limit, $lpp),
                array($this->_table, $pids),
                'id'
            );
        }else{

            $result = DB::fetch_all(
                "SELECT * FROM %t  WHERE status=1 $extwhere ORDER BY `displayorder` ASC,digest DESC,id DESC,catid DESC " . DB::limit($start_limit, $lpp),
                array($this->_table),
                'id'
            );
        }
        return $result;
    }

    public function fetch_all_by_geo($lat, $lng, $pids, $start_limit , $lpp, $extwhere = ''){

        if($pids){
            $sql = "SELECT *, acos(cos((lng - %s) * 0.01745329252) * cos((lat - %s) * 0.01745329252)) * 6371004 as distance FROM %t WHERE catid IN(%n) AND status=1 $extwhere ORDER BY distance ASC";

            $result = DB::fetch_all(
                $sql . DB::limit($start_limit, $lpp),
                array($lng,$lat, $this->_table, $pids),
                'id'
            );
        }else{
            $sql = "SELECT *, acos(cos((lng - %s) * 0.01745329252) * cos((lat - %s) * 0.01745329252)) * 6371004 as distance FROM %t WHERE status=1  $extwhere ORDER BY distance ASC";

            $result = DB::fetch_all(
                $sql . DB::limit($start_limit, $lpp),
                array($lng,$lat, $this->_table),
                'id'
            );
        }
        foreach ($result as $k => $v) {
            $distance = intval($v['distance']);
            if($distance<=1000){
                $distance = intval($distance). 'm';
            }else if($distance>1000){
                $distance = round($distance/1000, 1). 'km';
            }
            $result[$k]['distance'] = $distance;
        }

        return $result;
    }

    public function _count_by_pids($pids){
        if($pids){
            $result = DB::result_first(
                'SELECT count(*) FROM %t  WHERE catid IN(%n) AND status=1',
                array($this->_table, $pids)
            );
        }else{

            $result = DB::result_first(
                'SELECT count(*) FROM %t  WHERE status=1',
                array($this->_table,)
            );
        }
        return $result;
    }

    public function check_phone($phone, $ignore_id = 0)
    {
        return false;
        $data = array();
        $where = '';
        if(!empty($phone)) {
            if($ignore_id){
                $where = ' AND id!='.intval($ignore_id);
            }
            $data = DB::fetch_first(
                "SELECT phone FROM %t WHERE phone=%s $where",
                array(
                    $this->_table,
                    $phone
                ));
        }
        return $data;
    }

    public function multi_update($data)
    {
        foreach ($data as $id => $row) {
            if($this->check_phone($row['phone'])){
                unset($row['phone']);
            }
            if(empty($row['nearby'])){
                $row['nearby'] = 0;
            }
            DB::update($this->_table, $row, array($this->_pk => $id));
        }
        return TRUE;
    }

    public function _count($only_uncheck = 0) {
        if($only_uncheck){
            $where = ' WHERE status = 0';
        }else{
            $where = ' WHERE status=1';
        }
        $count = (int) DB::result_first("SELECT count(*) FROM ".DB::table($this->_table) . $where);
        return $count;
    }

    public function _count_search($searchkey = '') {
        if(!$searchkey){
            return 0;
        }
        $searchkey = stripsearchkey($searchkey);
        $where = " WHERE (phone LIKE '%$searchkey%' OR company_name LIKE '%$searchkey%' OR city LIKE '%$searchkey%' OR dist LIKE '%$searchkey%' OR address LIKE '%$searchkey%') AND status=1 ";
        $count = (int) DB::result_first("SELECT count(*) FROM ".DB::table($this->_table) . $where);
        return $count;
    }

    public function fetch_all_by_search($start_limit , $lpp, $searchkey = ''){
        if(!$searchkey){
            return array();
        }
        $searchkey = stripsearchkey($searchkey);
        $where = " WHERE (phone LIKE '%$searchkey%' OR company_name LIKE '%$searchkey%' OR city LIKE '%$searchkey%' OR dist LIKE '%$searchkey%' OR address LIKE '%$searchkey%') AND status=1 ";
        $result = DB::fetch_all(
            'SELECT * FROM '.DB::table($this->_table)." $where ORDER BY catid DESC,`displayorder` ASC,id DESC " . DB::limit($start_limit, $lpp),
            array(),
            'id'
        );
        return $result;
    }

    public function fetch_city_dist($field = '', $catid = array()){
        $cat = '';
        if($catid){
            $catid = dintval($catid, true);
            $cat = ' AND catid IN ('.implode(',',$catid).')';
        }
        return DB::fetch_all("SELECT distinct $field FROM %t WHERE $field!='' AND status=1 $cat group BY `$field`", array($this->_table), $field);
    }
}