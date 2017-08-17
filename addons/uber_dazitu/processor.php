<?php
defined('IN_IA') or exit('Access Denied');
include "model.php";
class Uber_DazituModuleProcessor extends WeModuleProcessor
{
    public function respond()
    {
        global $_W, $_GPC;
        $msgtype = trim($this->message['msgtype']);
        $rid     = $this->rule;
        $sql     = "SELECT * FROM " . tablename('uber_dazitu_reply') . " WHERE `rid`=:rid LIMIT 1";
        $row     = pdo_fetch($sql, array(
            ':rid' => $rid
        ));
        $openid  = $this->message['from'];
        $name    = trim($this->message['content']);
        $config  = $this->module['config'];
        if (!$this->inContext) {
            $reply = $row['ruletext'];
            $this->beginContext();
            return $this->respText($reply);
        } else {
            if ($name == '结束' || $name == '退出') {
                $this->endContext();
                return $this->respText('退出成功');
            }
            $rkey = $_SESSION['__rkey'];
            if (is_numeric($name) && in_array($name, array(
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10
            ))) {
                $_SESSION['__rkey'] = $name;
                $rkey               = $_SESSION['__rkey'];
                return $this->respText('设置模板成功');
            }
            $textLength = strlen($name) / 3;
            if ($textLength > 30) {
                return $this->respText('请输入30位以内字符：');
            }
            if ($msgtype == 'text') {
                $selectstyle = array(
                    1 => array(
                        'style' => $row['q1'],
                        'fontsize' => 46,
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'type' => 0
                    ),
                    2 => array(
                        'style' => $row['q2'],
                        'fontsize' => 46,
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'type' => 0
                    ),
                    3 => array(
                        'style' => $row['q3'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 720,
                        'x' => 0,
                        'y' => 0,
                        'type' => 3
                    ),
                    4 => array(
                        'style' => $row['q4'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 700,
                        'x' => 0,
                        'y' => 0,
                        'type' => 4
                    ),
                    5 => array(
                        'style' => $row['q5'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 720,
                        'x' => 0,
                        'y' => 0,
                        'type' => 3
                    ),
                    6 => array(
                        'style' => $row['q6'],
                        'fontsize' => 46,
                        'left' => 10,
                        'top' => 650,
                        'x' => 0,
                        'y' => 0,
                        'type' => 1
                    ),
                    7 => array(
                        'style' => $row['q7'],
                        'fontsize' => 46,
                        'left' => 10,
                        'top' => 650,
                        'x' => 0,
                        'y' => 0,
                        'type' => 1
                    ),
                    8 => array(
                        'style' => $row['q8'],
                        'fontsize' => 46,
                        'left' => 3000,
                        'top' => 988,
                        'x' => 0,
                        'y' => 0,
                        'type' => 2
                    ),
                    9 => array(
                        'style' => $row['q9'],
                        'fontsize' => 46,
                        'left' => 3000,
                        'top' => 988,
                        'x' => 0,
                        'y' => 0,
                        'type' => 2
                    ),
                    10 => array(
                        'style' => $row['q10'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 600,
                        'x' => 0,
                        'y' => 0,
                        'type' => 4
                    )
                );
                if (empty($rkey))
                    $rkey = mt_rand(1, 10);
                $bgkey = $selectstyle[$rkey]['style'];
                $bg    = getFilename($bgkey, $config);
                set_time_limit(0);
                @ini_set('memory_limit', '256M');
                $size   = getimagesize($bg);
                $target = imagecreatetruecolor($size[0], $size[1]);
                $bg     = imageCreates($bg);
                imagecopy($target, $bg, 0, 0, 0, 0, $size[0], $size[1]);
                imagedestroy($bg);
                if ($selectstyle[$rkey]['type'] >= 1) {
                    $datamerge = array(
                        'left' => $selectstyle[$rkey]['left'],
                        'top' => $selectstyle[$rkey]['top'],
                        'x' => $selectstyle[$rkey]['x'],
                        'y' => $selectstyle[$rkey]['y'],
                        'width' => $size[0],
                        'height' => 105
                    );
                } else {
                    $datamerge = array(
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'width' => $size[0],
                        'height' => 105
                    );
                }
                mergeImage($target, getFilename($row['qrcode'], $config), $datamerge);
                $fonts = MODULE_ROOT . "/data/font.ttf";
                if ($selectstyle[$rkey]['type'] >= 1) {
                    $datatext = array(
                        'size' => $selectstyle[$rkey]['fontsize'],
                        'color' => '#000',
                        'left' => 130,
                        'top' => 235,
                        'type' => $selectstyle[$rkey]['type']
                    );
                } else {
                    $datatext = array(
                        'size' => 46,
                        'color' => '#000',
                        'left' => 130,
                        'top' => 235,
                        'type' => 0
                    );
                }
                mergeTexts($target, $name, $datatext, $fonts);
                $savefile = "" . date('YmdHis') . random(5) . ".jpg";
                $patharr  = imagePath($config);
                $imageUrl = imageSave($target, $patharr, $savefile, $config);
                $indexUrl = mobileUrl('createpicture', array(
                    'rid' => $rid,
                    'openid' => $openid,
                    'fromimg' => base64_encode($imageUrl)
                ));
                $resptext = "<a href='{$indexUrl}'>朋友圈气泡帮您吹好了，请点击去用吧</a>";
                if (!empty($row['awardtext']))
                    $resptext = "<a href='{$indexUrl}'>{$row['awardtext']}</a>";
                return $this->respText($resptext);
            }
        }
    }
}

?>