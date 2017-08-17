<?php
/**
 * 弹幕模块定义
 *悟空源码网www.5kym.com
 */
defined('IN_IA') or exit('Access Denied');
define('TOKER_DANMU', IA_ROOT . '/addons/toker_danmu/');

function Sec2Time($time) {
    if (is_numeric($time)) {
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if ($time >= 31556926) {
            $value["years"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 86400) {
            $value["days"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hours"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["minutes"] = floor($time / 60);
            $time = ($time % 60);
        }
        $value["seconds"] = floor($time);
        //return (array) $value;
        if ($value["years"] > 0) {
            $t = $value["years"] . "年" . $value["days"] . "天" . $value["hours"] . "小时" . $value["minutes"] . "分" . $value["seconds"] . "秒";
        } else {
            if ($value["days"] > 0) {
                $t = $value["days"] . "天" . $value["hours"] . "小时" . $value["minutes"] . "分" . $value["seconds"] . "秒";
            } else {
                if ($value["hours"] > 0) {
                    $t = $value["hours"] . "小时" . $value["minutes"] . "分" . $value["seconds"] . "秒";
                } else {
                    if ($value["minutes"] > 0) {
                        $t = $value["minutes"] . "分" . $value["seconds"] . "秒";
                    } else {
                        $t = $value["seconds"] . "秒";
                    }
                }
            }
        }

        Return $t;
    } else {
        return (bool) FALSE;
    }
}

class Toker_danmuModuleSite extends WeModuleSite {

    public $danmu_db = "toker_danmu";

    public function doWebDanmu_manage() {
        global $_W, $_GPC;
		$danmu = pdo_fetch("select * from " . tablename($this->danmu_db) . " where uniacid = {$_W['uniacid']}");
        if (checksubmit('submit')) {
            $path = TOKER_DANMU . "data/danmu/";
            $file = $path . 'danmu_' . $_W['uniacid'] . '.js';
			if (!is_dir($path)) {
                load()->func('file');
                mkdirs($path);
            }
            if (!is_file($file)) {
				//message('999');
				$diycode = '
                    var i=0;
                    $(function(){
                        var s = document.createElement("link");
                        s.rel = "stylesheet";
                        s.type = "text/css";
                        s.href = "' . $_W["siteroot"] . 'addons/toker_danmu/css/danmu.css";
                        document.getElementsByTagName("head")[0].appendChild(s);
                      setTimeout(req,1000);

                    $("<div class=\'danmu\'><img src=\'\'/><p>最新订单来自<span class=\'dan_mc\'>xxx</span><span></span>之前</p></div>").appendTo("body");
                    function req(){
                            var danmu_url = "' . $_W["siteroot"] . 'app/index.php?i=' . $_W["uniacid"] . '&c=entry&m=toker_danmu&do=danmu";
                    $.post(
                                    danmu_url, {
                                        "type": "danmu"
                                    },
                                    function (data) {
                                          if(data.type == "error"){
                                              setTimeout(req,15000);
                                              return;
                                          }
                                          var sData = $.parseJSON(data.message );
                                          padd();
                                          function padd(){
                                                  if(i<sData.length){
                                                  $(".danmu img").attr("src",sData[i]["avatar"]);
                                                  $(".danmu p .dan_mc").text(sData[i]["nickname"]+"  "); 
                                                  $(".danmu p span").eq(1).text(sData[i]["time_before"])
                                                  danmu_xainxian();
                                                  i=i+1;
                                                }else{
                                                    setTimeout(req,15000);
                                                    i=0;
                                                }
                                            }
                                            function danmu_xainxian(){
                                                    $(".danmu").animate({top:20+"%",opacity:1},1000);
                                                    setTimeout(danmu_xiaoshi,5000);
                                            };
                                            function danmu_xiaoshi(){
                                                    $(".danmu").animate({top:10+"%",opacity:0},1000);
                                                    setTimeout(padd,3000);
                                            };
                                    },
                                    "json");  

                    };
                    });';
				//file_put_contents(file,$diycode);
                $handle = fopen($file, 'w+');
                fwrite($handle,$diycode);
				
            }
			//message('777');
            $time_range = !empty($_GPC['time_range']) ? intval($_GPC['time_range']) : 30;
            $data = array(
                'uniacid' => $_W['uniacid'],
                'vr_status' => intval($_GPC['vr_status']),
                'start_time1' => intval($_GPC['start_time1']),
                'end_time1' => intval($_GPC['end_time1']),
                'start_time2' => intval($_GPC['start_time2']),
                'end_time2' => intval($_GPC['end_time2']),
                'start_time3' => intval($_GPC['start_time3']),
                'end_time3' => intval($_GPC['end_time3']),
                'time_range' => $time_range,
                'number_range1' => intval($_GPC['number_range1']),
                'number_range2' => intval($_GPC['number_range2']),
                'number_range3' => intval($_GPC['number_range3']),
            );
            if (empty($danmu)) {
                pdo_insert($this->danmu_db, $data);
            } else {
                pdo_update($this->danmu_db, $data, array('uniacid' => $_W['uniacid']));
            }
            message('更新成功', $this->createWebUrl('danmu_manage'), 'success');
        }
        include $this->template('web/manage');
    }

    public function doMobileDanmu() {
        global $_W, $_GPC;
        load()->model('mc');
        $data = array();
        $danmu = pdo_fetch("select * from " . tablename('toker_danmu') . " where uniacid = {$_W['uniacid']}");
        $hour = date('H');
        $dan_on = false;
        if ($hour >= $danmu['start_time1'] && $hour < $danmu['end_time1']){
            $dan_on = true;
            $number_range = $danmu['number_range1'];
        }
         if ($hour >= $danmu['start_time2'] && $hour < $danmu['end_time2']){
            $dan_on = true;
            $number_range = $danmu['number_range2'];
        }
         if ($hour >= $danmu['start_time3'] && $hour < $danmu['end_time3']){
            $dan_on = true;
            $number_range = $danmu['number_range3'];
        }
        if ($dan_on) {
            for ($i = 0; $i < $number_range; $i++) {
                $random = mt_rand(1, 1000);
                if ($danmu['time_range'] > 1) {
                    $time_before = mt_rand(1, $danmu['time_range']);
                }
                $member = pdo_fetch("select nickname,avatar from " . tablename('toker_danmu_vr_member') . " where id = {$random}");
                $data[$i]['nickname'] = $member['nickname'];
                $data[$i]['avatar'] = tomedia($member['avatar']);
                $data[$i]['time_before'] = Sec2Time($time_before);
            }
        }

        // print_r($data);die;
        if (empty($data)) {
            message('', '', 'error');
        } else {
            message(json_encode($data), '', 'success');
        }
    }

}
