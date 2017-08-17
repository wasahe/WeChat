<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_xigua114_cat extends  discuz_table
{
    public $arr = array();

    public $nbsp = "&nbsp;";

    public $ret = '';

    public $child = array();

    public $tree_id = 'id';
    public $tree_pid = 'pid';

    /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
    public function __construct()
    {
        $this->_table = 'plugin_xigua114_cat';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function count_by_page(){
        $result = DB::result_first(
            'SELECT count(*) FROM %t  WHERE pid=0 ',
            array($this->_table)
        );
        return $result;
    }

    public function fetch_all_by_page($start_limit , $lpp){
        $result = DB::fetch_all(
            "SELECT * FROM %t  WHERE pid=0  ORDER BY o ASC,id ASC " . DB::limit($start_limit, $lpp),
            array(
                $this->_table,
            ),
            $this->_pk
        );

        $sub_result = DB::fetch_all(
            "SELECT * FROM %t  WHERE pid in(%n)  ORDER BY o ASC,id ASC ",
            array(
                $this->_table,
                array_keys($result),
            ),
            $this->_pk
        );

        return array_merge($result, $sub_result);
    }

    public function list_all($simple = 0, $key = false)
    {
        if($simple){
            $field = 'id,pid,name';
        }else{
            $field = '*';
        }
        if($key){
            return DB::fetch_all("SELECT $field FROM %t ORDER BY o ASC,id ASC", array($this->_table), $this->_pk);
        }else{
            return DB::fetch_all("SELECT $field FROM %t ORDER BY o ASC,id ASC", array($this->_table));
        }
    }

    public function list_by_pushtype()
    {
        return DB::fetch_all("SELECT id,name,icon,pushtype FROM %t WHERE pushtype!='' ORDER BY o ASC,id ASC LIMIT 10", array($this->_table));
    }

    public function list_by_pid($pid = 0, $only_display = false)
    {
        $where = '';
        if($only_display){
            $where = ' AND pos!=\'nil\' ';
        }
        return DB::fetch_all("SELECT * FROM %t WHERE pid=%d OR id=%d $where ORDER BY o ASC,id ASC", array(
            $this->_table,
            $pid,
            $pid,
        ));
    }

    public function get_childs_by_pids($pids){
        $childs = DB::fetch_all("SELECT id,pid,`name` FROM %t WHERE pid IN (%n) ORDER BY o ASC,id ASC", array(
            $this->_table,
            $pids
        ));
        return $childs;
    }

    public function get_pid_by_childs($childids){
        $childs = DB::fetch_first("SELECT id,pid FROM %t WHERE id IN (%n)", array(
            $this->_table,
            $childids
        ));
        return $childs;
    }

    public function do_delete($id)
    {
        $has = DB::fetch_first('SELECT pid FROM %t WHERE pid=%d', array(
            $this->_table,
            $id
        ));
        if($has){
            return false;
        }
        return $this->delete($id);
    }

    public function do_pushtype($id, $pushtype)
    {
        $r = DB::query("UPDATE %t SET pushtype=%s WHERE id=%d", array(
            $this->_table,
            $pushtype,
            $id
        ));
        if(!$r){
            $r = DB::query("UPDATE %t SET pushtype=%s WHERE id=%d", array(
                $this->_table,
                '',
                $id
            ));
        }
        return $r;
    }

    public function init($arr = array()) {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }

    public function get_parent($myid) {
        $newarr = array();
        if (!isset($this->arr[$myid]))
            return false;
        $pid = $this->arr[$myid][$this->tree_pid];
        $pid = $this->arr[$pid][$this->tree_pid];
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a[$this->tree_pid] == $pid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr;
    }

    public function get_child($myid) {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a[$this->tree_pid] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    public function get_all_child($myid) {
        $number = 1;
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                $this->child[]= $value;
                $this->get_all_child($value[$this->tree_id]);
                $number++;
            }
        }
        return $this->child;
    }

    public function get_pos($myid, &$newarr) {
        $a = array();
        if (!isset($this->arr[$myid]))
            return false;
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid][$this->tree_pid];
        if (isset($this->arr[$pid])) {
            $this->get_pos($pid, $newarr);
        }
        if (is_array($newarr)) {
            krsort($newarr);
            foreach ($newarr as $v) {
                $a[$v[$this->tree_id]] = $v;
            }
        }
        return $a;
    }

    public function get_tree_array($myid) {
        $retarray = array();
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                @extract($value);
                $retarray[$id] = $value;
                $retarray[$id]["child"] = $this->get_tree_array($id, '');
            }
        }
        return $retarray;
    }

    private function have($list, $item) {
        return(strpos(',,' . $list . ',', ',' . $item . ','));
    }
}