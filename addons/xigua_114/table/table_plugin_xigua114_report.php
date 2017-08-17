<?php
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_xigua114_report extends  discuz_table
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
        $this->_table = 'plugin_xigua114_report';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function _count($waiting = 1)
    {
        if($waiting){
            $where = ' WHERE status = 0';
        }else{
            $where = ' WHERE status != 0';
        }
        $count = (int) DB::result_first("SELECT count(*) FROM ".DB::table($this->_table) . $where);
        return $count;
    }

    public function fetch_all_by_page($start_limit , $lpp, $waiting = 1){
//        if($waiting){
//            $where = ' WHERE status = 0';
//        }else{
//            $where = ' WHERE status != 0';
//        }
        $where = '';
        $result = DB::fetch_all(
            'SELECT * FROM '.DB::table($this->_table)." $where ORDER BY status DESC, id DESC " . DB::limit($start_limit, $lpp),
            array(),
            'id'
        );
        return $result;
    }
}