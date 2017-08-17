<?php
/**
 * 全民点灯
 * 易 福 源 码 网 www.efwww.com
 */
defined('IN_IA') or exit('Access Denied');

class weisrc_diandengModule extends WeModule {

    public $tablename = 'weisrc_diandeng_reply';
    public $tableaward = 'weisrc_diandeng_award';

    public function fieldsFormDisplay($rid = 0) {
        global $_W;
        load()->func('tpl');
        if (!empty($rid)) {
            $reply = pdo_fetch("SELECT * FROM " . tablename($this->tablename) . " WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
            $prize = pdo_fetchall("SELECT * FROM " . tablename($this->tableaward) . " WHERE rid = :rid ORDER BY `id` asc", array(':rid' => $rid));
        }

        if (!$reply) {
            $now = time();
            $reply = array(
                "title" => "点灯笼赢年货",
                "start_picurl" => "",
                "description" => "欢迎参加全民点灯活动",
                "repeat_lottery_reply" => "亲，继续努力哦~~",
                "ticket_information" => "兑奖请联系我们,电话: 13888888888",
                "starttime" => $now,
                "endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
                "end_theme" => "全民点灯活动已经结束了",
                "end_instruction" => "亲，活动已经结束，请继续关注我们的后续活动哦~",
                "end_picurl" => "",
                "rule" => '活动进行到x月x号x点，这个时间之前的中奖用户可以正常兑奖。（仅供用户体验产品功能使用，所产生奖品将不予兑换哦！）<br style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            1、玩家进入游戏后，点击屏幕上方的“点亮灯笼”，灯笼点亮，随后分享给好友。<br
                    style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            2、好友点击分享链接进入活动，点击“帮他点亮灯笼”按钮，灯笼点亮。<br
                    style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            3、本次活动共设置4个灯笼，点亮的的灯笼为“新年快乐”的玩家可以兑奖。<br
                    style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            4、本次活动只允许兑换一次奖，先兑先得，达到兑奖的条件后，可以兑换奖品。',
                "rule2" => '1、本次活动设置奖品为iphone6s.iphone6.iphone5s。按排行榜先后领取奖品。<br
                style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            2、手机号码作为唯一兑奖凭证，请务必填写正确，如若号码有误，视为弃权哦!<br
                    style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            3、兑奖有效期为3天，请小伙伴们密切关注活动。<br
                    style="margin:0px;padding:0px;border:0px;-webkit-tap-highlight-color:transparent;line-height:23px;white-space:normal;widows:auto;"/>
            4、本活动最终解释权归xxx所有.',
                "most_num_times" => 1,
                "number_times" => 0,
                "probability" => 0,
                "award_times" => 1,
                "share_title" => "#username#邀请你点灯笼赢大奖",
                "share_desc" => "快乐帮我点灯笼!",
                "share_image" => "../addons/weisrc_diandeng/icon.jpg",
                "share_txt" => "",
                "c_unit_one" => "个",
                "c_unit_two" => "个",
                "c_unit_three" => "个",
                "c_unit_four" => "个",
                "c_name_one" => "新",
                "c_name_two" => "年",
                "c_name_three" => "快",
                "c_name_four" => "乐",
                "c_rate_one" => "100",
                "c_rate_two" => "100",
                "c_rate_three" => "100",
                "c_rate_four" => "100",
                "day_times" => "5",
                "total_times" => "10",
                "mode" => "1",
                'logo' => "../addons/weisrc_diandeng/template/mobile/images/logo.png",
                'bg' => "../addons/weisrc_diandeng/template/mobile/images/bg.jpg",
                'light' => "../addons/weisrc_diandeng/template/mobile/images/light1.png",
                'light2' => "../addons/weisrc_diandeng/template/mobile/images/light2.png",
                'paper' => "../addons/weisrc_diandeng/template/mobile/images/paper.png",
                'music_url' => "../addons/weisrc_diandeng/template/mobile/images/bj.mp3",
                "isusername" => "1",
                "istel" => "1",
                "isaddress" => "1"
            );
        }

        include $this->template('form');
    }

    public function fieldsFormValidate($rid = 0) {
        //规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
        return '';
    }

    public function fieldsFormSubmit($rid) {
        global $_GPC, $_W;
        load()->func('tpl');
        $uniacid = $_W['uniacid'];
        $id = intval($_GPC['reply_id']);

        $insert = array(
            'rid' => $rid,
            'uniacid' => $_W['uniacid'],
            'title' => $_GPC['title'],
            'content' => $_GPC['content'],
            'ticket_information' => $_GPC['ticket_information'],
            'description' => $_GPC['description'],
            'rule' => $_GPC['rule'],
            'mode' => intval($_GPC['mode']),
            'rule2' => $_GPC['rule2'],
            'repeat_lottery_reply' => $_GPC['repeat_lottery_reply'],
            'end_theme' => $_GPC['end_theme'],
            'end_instruction' => $_GPC['end_instruction'],
            'probability' => $_GPC['probability'],
            'c_img1_one' => $_GPC['c_img1_one'],
            'c_img2_one' => $_GPC['c_img2_one'],
            'c_name_one' => $_GPC['c_name_one'],
            'c_num_one' => $_GPC['c_num_one'],
            'c_img1_two' => $_GPC['c_img1_two'],
            'c_img2_two' => $_GPC['c_img2_two'],
            'c_name_two' => $_GPC['c_name_two'],
            'c_num_two' => $_GPC['c_num_two'],
            'c_img1_three' => $_GPC['c_img1_three'],
            'c_img2_three' => $_GPC['c_img2_three'],
            'c_name_three' => $_GPC['c_name_three'],
            'c_num_three' => $_GPC['c_num_three'],
            'c_img1_four' => $_GPC['c_img1_four'],
            'c_img2_four' => $_GPC['c_img2_four'],
            'c_name_four' => $_GPC['c_name_four'],
            'c_num_four' => $_GPC['c_num_four'],
            'c_img1_five' => $_GPC['c_img1_five'],
            'c_img2_five' => $_GPC['c_img2_five'],
            'c_name_five' => $_GPC['c_name_five'],
            'c_num_five' => $_GPC['c_num_five'],
            'c_img1_six' => $_GPC['c_img1_six'],
            'c_img2_six' => $_GPC['c_img2_six'],
            'c_name_six' => $_GPC['c_name_six'],
            'c_num_six' => $_GPC['c_num_six'],
            'total_award' => $_GPC['total_award'],
            'award_times' => $_GPC['award_times'],
            'number_times' => 0,
            'most_num_times' => $_GPC['most_num_times'],
            'show_num' => $_GPC['show_num'],
            'dateline' => TIMESTAMP,
            'copyright' => $_GPC['copyright'],
            'copyrighturl' => $_GPC['copyrighturl'],
            'share_title' => $_GPC['share_title'],
            'share_desc' => $_GPC['share_desc'],
            'share_image' => $_GPC['share_image'],
            'share_url' => $_GPC['share_url'],
            'share_txt' => $_GPC['share_txt'],
            'starttime' => strtotime($_GPC['datelimit']['start']),
            'endtime' => strtotime($_GPC['datelimit']['end']),
            'c_rate_one' => $_GPC['c_rate_one'],
            'c_rate_two' => $_GPC['c_rate_two'],
            'c_rate_three' => $_GPC['c_rate_three'],
            'c_rate_four' => $_GPC['c_rate_four'],
            'c_rate_five' => $_GPC['c_rate_five'],
            'c_rate_six' => $_GPC['c_rate_six'],
            'c_rate_seven' => $_GPC['c_rate_seven'],
            'c_rate_eight' => $_GPC['c_rate_eight'],
            'c_unit_one' => $_GPC['c_unit_one'],
            'c_unit_two' => $_GPC['c_unit_two'],
            'c_unit_three' => $_GPC['c_unit_three'],
            'c_unit_four' => $_GPC['c_unit_four'],
            'c_unit_five' => $_GPC['c_unit_five'],
            'isweixin' => $_GPC['isweixin'],
            'isage' => $_GPC['isage'],
            'award_url' => $_GPC['award_url'],
            'award_tip' => $_GPC['award_tip'],
            'follow_url' => $_GPC['follow_url'],
            'address' => $_GPC['address'],
            'start_picurl' => $_GPC['start_picurl'],
            'end_picurl' => $_GPC['end_picurl'],
            'logo' => $_GPC['logo'],
            'bg' => $_GPC['bg'],
            'qrcode' => $_GPC['qrcode'],
            'light' => $_GPC['light'],
            'light2' => $_GPC['light2'],
            'paper' => $_GPC['paper'],
            'music_url' => $_GPC['music_url'],
            'isneedfollow' => intval($_GPC['isneedfollow']),
            'ishelpfollow' => intval($_GPC['ishelpfollow']),
            'isusername' => intval($_GPC['isusername']),
            'istel' => intval($_GPC['istel']),
            'isaddress' => intval($_GPC['isaddress']),
            'day_times' => intval($_GPC['day_times']),
            'total_times' => intval($_GPC['total_times'])
        );

        $insert['total_num'] = intval($_GPC['c_num_one']) + intval($_GPC['c_num_two']) + intval($_GPC['c_num_three']) + intval($_GPC['c_num_four']) + intval($_GPC['c_num_five']) + intval($_GPC['c_num_six']);

        if (empty($id)) {
            if ($insert['starttime'] <= time()) {
                $insert['isshow'] = 1;
            } else {
                $insert['isshow'] = 0;
            }
            $id = pdo_insert($this->tablename, $insert);

        } else {
            unset($insert['c_num_one']);
            unset($insert['c_num_two']);
            unset($insert['c_num_three']);
            unset($insert['c_num_four']);
            pdo_update($this->tablename, $insert, array('id' => $id));
        }

        if (!empty($_GPC['prizename'])) {
            foreach ($_GPC['prizename'] as $index => $prizename) {
                if (empty($prizename)) {
                    continue;
                }
                $insertprize = array(
                    'rid' => $rid,
                    'uniacid' => $_W['uniacid'],
                    'prizetype' => $_GPC['prizetype'][$index],
                    'prizename' => $_GPC['prizename'][$index],
                    'prizetotal' => $_GPC['prizetotal'][$index],
                    'prizepic' => $_GPC['prizepic'][$index],
                    'dateline' => TIMESTAMP
                );
                pdo_update($this->tableaward, $insertprize, array('id' => $index));
            }
        }
        if (!empty($_GPC['prizename_new'])&&count($_GPC['prizename_new'])>=1) {

            foreach ($_GPC['prizename_new'] as $index => $credit_type) {
                if (empty($credit_type)) {
                    continue;
                }
                $insertprize = array(
                    'rid' => $rid,
                    'uniacid' => $_W['uniacid'],
                    'prizetype' => $_GPC['prizetype_new'][$index],
                    'prizename' => $_GPC['prizename_new'][$index],
                    'prizetotal' => $_GPC['prizetotal_new'][$index],
                    'prizepic' => $_GPC['prizepic_new'][$index],
                );
                pdo_insert($this->tableaward, $insertprize);
            }
        }
        return true;
    }

    public function getNewSncode($uniacid, $sncode)
    {
        global $_W, $_GPC;
        $sn = pdo_fetch("SELECT sn FROM " . tablename('weisrc_diandeng_sncode') . " WHERE uniacid = :uniacid and sn = :sn ORDER BY `id` DESC limit 1", array(':uniacid' => $uniacid, ':sn' => $sncode));
        if (!empty($sn)) {
            $sncode = 'A00' . random(11, 1);
            $this->getNewSncode($uniacid, $sncode);
        }
        return $sncode;
    }

    public function ruleDeleted($rid) {
        pdo_delete('weisrc_diandeng_award', array('rid' => $rid));
        pdo_delete('weisrc_diandeng_reply', array('rid' => $rid));
        pdo_delete('weisrc_diandeng_fans', array('rid' => $rid));
    }

    public function settingsDisplay($settings) {
        global $_GPC, $_W;
        if(checksubmit()) {
            $cfg = array();
            $cfg['collectword']['appid'] = $_GPC['appid'];
            $cfg['collectword']['secret'] = $_GPC['secret'];
            $cfg['collectword']['followurl'] = $_GPC['followurl'];
            if($this->saveSettings($cfg)) {
                message('保存成功', 'refresh');
            }
        }
        include $this->template('setting');
    }
}

/**
 * 导出Excel
 *
 * @package:     Jason
 * @subpackage:  Excel
 * @version:     1.0
 */
class Jason_Excel_Export
{
    /**
     * Excel 标题
     *
     * @type: Array
     */
    private $_titles            = array();

    /**
     * Excel 标题数目
     *
     * @type: int
     */
    private $_titles_count      = 0;

    /**
     * Excel 内容
     *
     * @type:  Array
     */
    private $_contents          = array();

    /**
     * Excel 内容数据
     *
     * @type:  Array
     */
    private $_contents_count    = 0;

    /**
     * Excel 文件名
     *
     * @type: string
     */
    private $_fileName  = '';
    private $_split     = "\t";

    private $_charset   = '';

    /**
     * 默认文件名
     *
     * @const :
     */
    const DEFAULT_FILE_NAME = 'jason_excel.xls';


    /**
     * 构造函数..
     *
     * @param    string  param
     * @return   mixed   return
     */
    function __construct($fileName = null)
    {
        if ($fileName !== null)
        {
            $this->_fileName = $fileName;
        }
        else
        {
            $this->setFileName();
        }
    }

    /**
     * 设置生成文件名
     *
     * @param    string  param
     * @return   mixed   Jason_Excel_Export
     */
    public function setFileName($fileName = self::DEFAULT_FILE_NAME)
    {
        $this->_fileName = $fileName;
        $this->setSplite();
        return $this;
    }

    private function _getType()
    {
        return substr($this->_fileName, strrpos($this->_fileName, '.') + 1);
    }

    public function setSplite($split = null)
    {
        if ($split === null)
        {
            switch ($this->_getType())
            {
                case 'xls': $this->_split = "\t"; break;
                case 'csv': $this->_split = ","; break;
            }
        }
        else
            $this->_split = $split;
    }

    /**
     * 设置Excel标题
     *
     * @param    string  param
     * @return   mixed   Jason_Excel_Export
     */
    public function setTitle(&$title = array())
    {
        $this->_titles = $title;
        $this->_titles_count = count($title);
        return $this;
    }

    /**
     * 设置Excel内容
     *
     * @param    string  param
     * @return   mixed   Jason_Excel_Export
     */
    public function setContent(&$content = array())
    {
        $this->_contents          = $content;
        $this->_contents_count    = count($content);
        return $this;
    }

    /**
     * 向excel中添加一行内容
     */
    public function addRow($row = array())
    {
        $this->_contents[] = $row;
        $this->_contents_count++;
        return $this;
    }

    /**
     * 向excel中添加多行内容
     */
    public function addRows($rows = array())
    {
        $this->_contents = array_merge($this->_contents, $rows);
        $this->_contents_count += count($rows);
        return $this;
    }


    /**
     * 数据编码转换
     */
    public function toCode($type = 'GB2312', $from = 'auto')
    {
        foreach ($this->_titles as $k => $title)
        {
            $this->_titles[$k] = mb_convert_encoding($title, $type, $from);
        }

        foreach ($this->_contents as $i => $contents)
        {
            $this->_contents[$i] = $this->_toCodeArr($contents);
        }

        return $this;
    }

    private function _toCodeArr(&$arr = array(), $type = 'GB2312', $from = 'auto')
    {
        foreach ($arr as $k => $val)
        {
            $arr[$k] = mb_convert_encoding($val, $type, $from);
        }

        return $arr;
    }

    public function charset($charset = '')
    {
        if ($charset == '')
            $this->_charset = '';
        else
        {
            $charset = strtoupper($charset);
            switch($charset)
            {
                case 'UTF-8' :
                case 'UTF8' :
                    $this->_charset = ';charset=UTF-8';
                    break;

                default:
                    $this->_charset = ';charset=' . $charset;
            }
        }

        return $this;
    }



    /**
     * 导出Excel
     *
     * @param    string  param
     * @return   mixed   return
     */
    public function export()
    {
        $header = '';
        $data   = array();

        $header = implode($this->_split, $this->_titles);

        for ( $i = 0; $i < $this->_contents_count; $i++ )
        {
            $line_arr   = array();
            foreach ( $this->_contents[$i] as $value )
            {
                if (!isset($value) || $value == "")
                {
                    $value = '""';
                }
                else
                {
                    $value = str_replace('"', '""', $value);
                    $value = '"' . $value . '"';
                }

                $line_arr[] = $value;
            }

            $data[] = implode($this->_split, $line_arr);
        }

        $data = implode("\n", $data);
        $data = str_replace("\r", "", $data);

        if ($data == "")
        {
            $data = "\n(0) Records Found!\n";
        }

        header("Content-type: application/vnd.ms-excel" . $this->_charset);
        header("Content-Disposition: attachment; filename=$this->_fileName");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "\xEF\xBB\xBF".$header . "\n" . $data;
    }
}
