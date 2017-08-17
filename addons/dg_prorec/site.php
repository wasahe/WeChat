<?php
/**
 * 产品介绍群发模块微站定义
 *
 * @author 夺冠互动
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define('ROOT_PATH', str_replace('site.php', '', str_replace('\\', '/', __FILE__)));
require_once"../addons/dg_prorec/WxPayPubHelper/"."WxPayPubHelper.php";
define('INC_PATH',ROOT_PATH.'inc/');
class Dg_prorecModuleSite extends WeModuleSite {
    public function sendTplNotice($touser, $template_id, $postdata, $url = '', $topcolor = '#FF683F'){
        global $_W;
        $Account = WeAccount::create($_W['account']);
        $Account->sendTplNotice($touser,$template_id,$postdata,$url,$topcolor);
    }
    public function getAllTpl(){
        global $_W;
        $Account = WeAccount::create($_W['account']);
        $token = $Account->fetch_token();
        $post_url="https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token={$token}";
        $response = ihttp_request($post_url);
        if(is_error($response)) {
            return error(-1, "访问公众平台接口失败, 错误: {$response['message']}");
        }
        $result = @json_decode($response['content'], true);
        if(empty($result)) {
            return error(-1, "接口调用失败, 元数据: {$response['meta']}");
        } elseif(!empty($result['errcode'])) {
            return error(-1, "访问微信接口错误, 错误代码: {$result['errcode']}, 错误信息: {$result['errmsg']},信息详情：{$this->error_code($result['errcode'])}");
        }
        return $result;
    }
    public function tplAll(){
        $templateall=$this->getAllTpl();
        $templist=$templateall['template_list'];
        foreach($templist as $key => &$row){
            $row['id']=$key;
            $row['content']=explode("\n",$row['content']);
            $row['first']=$row['content'][0];
            $last=intval(count($row['content'])-1);
            $keycount=intval($last-1);
            $row['remark']=$row['content'][$last];
            $row['keyword']=array_slice($row['content'],1,$keycount);
            for($i=0;$i<count($row['keyword']);$i++){
                $row['send'][]=explode("：",$row['keyword'][$i]);
            }
            unset($row);
        }
        return $templist;
    }
    /*
     * 支付信息设置
     * */
    public function findKJsetting(){
        global $_W;
        $tempuniacid=$_W['uniacid'];
        $tempappid=$_W['account']['key'];
        $tempappsecret=$_W['account']['secret'];
        if($_W["account"]["level"]<4){
            $tempuniacid=$_W['oauth_account']['acid'];
            $tempappid=$_W['oauth_account']['key'];
            $tempappsecret=$_W['oauth_account']['secret'];
        }
        $kjsetting=array();
        $setting = uni_setting($tempuniacid, array('payment'));
        $pay =(array)$setting['payment'];

        $kjsetting['appid']=$tempappid;
        $kjsetting['appsecret']=$tempappsecret;

        $kjsetting['mchid']=$pay['wechat']['mchid'];
        $kjsetting['shkey']=$pay['wechat']['apikey'];
        return $kjsetting;
    }

}