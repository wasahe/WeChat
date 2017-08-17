<?php
defined('IN_IA') or die('Access Denied');
define('UBER_RES', '../addons/uber_dazitu/template/mobile');
include "model.php";
class Uber_DazituModule extends WeModule
{
    public $table_reply = 'uber_dazitu_reply';
    public $table_fans = 'uber_dazitu_fans';
    public $table_share = 'uber_dazitu_share';
    public function fieldsFormDisplay($rid = 0)
    {
        global $_W;
        if (!empty($rid)) {
            $reply              = pdo_fetch("SELECT * FROM " . tablename($this->table_reply) . " WHERE uniacid='{$_W[uniacid]}' AND rid = :rid ORDER BY `id` DESC", array(
                ':rid' => $rid
            ));
            $reply['starttime'] = date("Y-m-d  H:i", $reply['starttime']);
            $reply['endtime']   = date("Y-m-d  H:i", $reply['endtime']);
        }
        if (empty($reply['prize'])) {
            $prizes = array(
                array(
                    'kw' => 1,
                    'level' => '一等奖',
                    'name' => "CK中性香水",
                    'num' => '1',
                    'rate' => '20',
                    'bio' => 'CK中性香水一份',
                    'mchid' => 0,
                    'img' => UBER_RES . '/default/images/default_prize1.png'
                ),
                array(
                    'kw' => 2,
                    'level' => '二等奖',
                    'name' => "暖风机",
                    'num' => '10',
                    'rate' => '30',
                    'bio' => '暖风机一个',
                    'mchid' => 0,
                    'img' => UBER_RES . '/default/images/default_prize2.png'
                ),
                array(
                    'kw' => 3,
                    'level' => '三等奖',
                    'name' => "加湿器",
                    'num' => '100',
                    'rate' => '50',
                    'bio' => '加湿器一只',
                    'mchid' => 0,
                    'img' => UBER_RES . '/default/images/default_prize3.png'
                )
            );
        } else {
            $prizes = iunserializer($reply['prize']);
        }
        if (!$reply['adimgurl']) {
            $reply['adimgurl'] = UBER_RES . '/default/images/ad.jpg';
        }
        if (!$reply['coverurl']) {
            $reply['coverurl'] = UBER_RES . '/default/images/front/cover.png';
        }
        if (!$reply['bgurl']) {
            $reply['bgurl'] = UBER_RES . '/default/images/short.gif';
        }
        if (!$reply['q1']) {
            $reply['q1'] = UBER_RES . '/default/images/front/1.png';
        }
        if (!$reply['q2']) {
            $reply['q2'] = UBER_RES . '/default/images/front/2.png';
        }
        if (!$reply['q3']) {
            $reply['q3'] = UBER_RES . '/default/images/front/3.png';
        }
        if (!$reply['q4']) {
            $reply['q4'] = UBER_RES . '/default/images/front/4.png';
        }
        if (!$reply['q5']) {
            $reply['q5'] = UBER_RES . '/default/images/front/5.png';
        }
        if (!$reply['q6']) {
            $reply['q6'] = UBER_RES . '/default/images/front/6.png';
        }
        if (!$reply['q7']) {
            $reply['q7'] = UBER_RES . '/default/images/front/7.png';
        }
        if (!$reply['q8']) {
            $reply['q8'] = UBER_RES . '/default/images/front/8.png';
        }
        if (!$reply['q9']) {
            $reply['q9'] = UBER_RES . '/default/images/front/9.png';
        }
        if (!$reply['q10']) {
            $reply['q10'] = UBER_RES . '/default/images/front/10.png';
        }
        if (!$reply['showusernum']) {
            $reply['showusernum'] = 100;
        }
        if (!$reply['gametime']) {
            $reply['gametime'] = 30;
        }
        if (!$reply['gamelevel']) {
            $reply['gamelevel'] = 3;
        }
        if (!$reply['ruletext']) {
            $reply['ruletext'] = '
欢迎使用大字图
关键词回复后 默认30分钟的有效对话制作气泡时间。
必须注意：
1.不能超过30字   
2.暂时不支持表情（emoji）
3.回复1-10的数字可以切换气泡模板
4."＃"可以用来强行分行
5.用"＃"或者增加字数可以使字体变小
6.默认30分钟，输入结束或退出可提前退出。';
        }
        if (!isset($reply['isprofile'])) {
            $reply['isprofile'] = 1;
        }
        load()->func('tpl');
        include $this->template('form');
    }
    public function fieldsFormValidate($rid = 0)
    {
        global $_GPC, $_W;
        
        if (strtotime($_GPC['starttime']) > strtotime($_GPC['endtime'])) {
            return '活动结束时间应该大于活动开始时间！';
        }
        return '';
    }
    public function fieldsFormSubmit($rid)
    {
        global $_GPC, $_W;
        load()->func('tpl');
        $id       = intval($_GPC['id']);
        $_profile = array(
            'umobile' => 1,
            'uname' => 1,
            'uaddress' => intval($_GPC['uaddress']),
            'uqq' => intval($_GPC['uqq'])
        );
        if (is_array($_profile)) {
            $profile = iserializer($_profile);
        }
        $data          = array(
            'rid' => $rid,
            'uniacid' => $_W['uniacid'],
            'title' => $_GPC['title'],
            'starttime' => strtotime($_GPC['starttime']),
            'endtime' => strtotime($_GPC['endtime']),
            'adimgurl' => $_GPC['adimgurl'],
            'adurl' => $_GPC['adurl'],
            'share_title' => $_GPC['share_title'],
            'share_image' => $_GPC['share_image'],
            'share_url' => $_GPC['share_url'],
            'share_desc' => $_GPC['share_desc'],
            'copyright' => htmlspecialchars_decode($_GPC['copyright']),
            'shownum' => $_GPC['shownum'],
            'exchange' => $_GPC['exchange'],
            'isfollow' => $_GPC['isfollow'],
            'followurl' => $_GPC['followurl'],
            'playtimes' => intval($_GPC['playtimes']),
            'everydaytimes' => intval($_GPC['everydaytimes']),
            'ruletext' => htmlspecialchars_decode($_GPC['ruletext']),
            'awardtext' => $_GPC['awardtext'],
            'isprofile' => intval($_GPC['isprofile']),
            'profile' => $profile,
            "gametime" => intval($_GPC['gametime']),
            "gamelevel" => intval($_GPC['gamelevel']),
            "showusernum" => intval($_GPC['showusernum']),
            "daysharenum" => intval($_GPC['daysharenum']),
            "mode" => intval($_GPC['mode']),
            "shareawardnum" => intval($_GPC['shareawardnum']),
            'bgurl' => $_GPC['bgurl'],
            'coverurl' => $_GPC['coverurl'],
            'qrcode' => $_GPC['qrcode'],
            'qrcodetext' => $_GPC['qrcodetext'],
            'bgmusic' => $_GPC['bgmusic'],
            'status' => 1,
            'createtime' => TIMESTAMP,
            'q1' => $_GPC['q1'],
            'q2' => $_GPC['q2'],
            'q3' => $_GPC['q3'],
            'q4' => $_GPC['q4'],
            'q5' => $_GPC['q5'],
            'q6' => $_GPC['q6'],
            'q7' => $_GPC['q7'],
            'q8' => $_GPC['q8'],
            'q9' => $_GPC['q9'],
            'q10' => $_GPC['q10']
        );
        $data['prize'] = '';
        if ($_GPC['prize']) {
            $prizes = array();
            foreach ($_GPC['prize'] as $key => $prize) {
                if ($prize != '') {
                    $prizes[] = array(
                        'kw' => $_GPC['prize_kw'][$key],
                        'level' => $_GPC['prize_level'][$key],
                        'name' => $_GPC['prize_name'][$key],
                        'num' => $_GPC['prize_num'][$key],
                        'rate' => $_GPC['prize_rate'][$key],
                        'bio' => $_GPC['prize'][$key],
                        'mchid' => $_GPC['prize_mchid'][$key],
                        'img' => $_GPC['prize_img'][$key]
                    );
                }
            }
            $data['prize'] = empty($prizes) ? '' : iserializer($prizes);
        }
        if (empty($id)) {
            pdo_insert($this->table_reply, $data);
        } else {
            pdo_update($this->table_reply, $data, array(
                'id' => $id
            ));
        }
        return true;
    }
    public function ruleDeleted($rid)
    {
        pdo_delete($this->table_reply, array(
            'rid' => $rid
        ));
        pdo_delete($this->table_fans, array(
            'rid' => $rid
        ));
        pdo_delete($this->table_share, array(
            'rid' => $rid
        ));
        return true;
    }
    public function settingsDisplay($settings)
    {
        global $_W, $_GPC;
        $styles = array();
        $dir    = IA_ROOT . "/addons/uber_dazitu/template/mobile/";
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != ".." && $file != ".") {
                    if (is_dir($dir . "/" . $file)) {
                        $styles[] = $file;
                    }
                }
            }
            closedir($handle);
        }
        if (checksubmit()) {
            $dat = array(
                'style' => $_GPC['style'],
                'savetype' => intval($_GPC['savetype']),
                'editor' => intval($_GPC['editor']),
                'ismerchant' => intval($_GPC['ismerchant'])
            );
            if (!$this->saveSettings($dat)) {
                message('配置参数保存失败', referer(), 'error');
            } else {
                message('配置参数更新成功！', referer(), 'success');
            }
        }
        include $this->template('settings');
    }
}
