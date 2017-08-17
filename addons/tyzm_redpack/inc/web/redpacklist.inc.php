<?php



/**

 * 红包管理

 *

 * @author tyzm

 * @url http://tyzm.net/

 */



defined('IN_IA') or exit('Access Denied');
 global $_GPC, $_W;
$tys = array('display','ajaxrepeat');
$ty=trim($_GPC['ty']);
$ty = in_array($ty, $tys) ? $ty : 'display';
$uniacid = intval($_W['uniacid']);
	
if($ty=='ajaxrepeat'){
	//重发
	$id=trim($_GPC['id']);
	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND id = :id AND ispay=:ispay", array(':uniacid' => $uniacid,':id' => trim($_GPC['aid']),':ispay' => 1));
	
	$lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE id=:id AND aid = :aid AND uniacid = :uniacid  AND isdel=0 ", array(':aid' => $redata['id'],':uniacid' => $uniacid,'id'=>$id));

	if(!empty($lickylog['tid'])&& $lickylog['result_code']!='SUCCESS'){     //第一次执行发红包动作&&红包发送不成功时，再执行多次执行，后台可以看到错误结果
	        $url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack',array('tid'=>$lickylog['tid'],'tokenkey'=>trim(base64_encode($redata['openid']))));
	        //异步发红包start
			//$this->doRequest($url);
			//$senddata=array(
			//    'openid'=>$lickylog['re_openid'],
			//	'local '=>1,
			//);
            //load()->func('communication');
           // request_by_fsockopen($url,$senddata);//异步请求发红包
			//异步发红包end
			//$result = ihttp_post($url, $senddata);
			//$this->makeRequest($url,$senddata,'POST');
			
			$senddata=array(
              'id'=>$redata['id'],
			  'send_name'=>$redata['send_name'],
			  'act_name' =>$redata['act_name'],
			  'remark' =>$redata['remark'],
			  'wishing' =>$redata['wishing'],
			  'number'=>$redata['number'],
            );
			$this->sendredpackt($lickylog['re_openid'],$senddata,0);
			//print_r($result);
			
			message('成功提交请求',$this->createWebUrl('redpacklist', array('id' => $lickylog['aid'])), 'success');
			
			
	}
}
	
if($ty=='display'){
	   
		load()->model('mc');
		
        $aid = intval($_GPC['id']);
		//分页start
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = '';
		if (!empty($_GPC['keyword'])) {
			$condition .= " AND CONCAT(`act_name`,`send_name`) LIKE '%{$_GPC['keyword']}%'";
		}
		$list = pdo_fetchall("SELECT * FROM ".tablename('tyzm_redpack_data')." WHERE uniacid = ".$uniacid." AND aid = $aid $condition ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tyzm_redpack_data') . " WHERE uniacid = ".$uniacid." AND aid = $aid $condition");
		$pager = pagination($total, $pindex, $psize);
		//分页end

		if(!empty($list)){

			foreach ($list as $key => $value) { 

                $list[$key]['userinfo']=mc_fansinfo($value['re_openid'],$_W['uniacid'], $_W['uniacid']);

                $list[$key]['total_amount']=$list[$key]['total_amount']/100;					

			}

		}
		include $this->template('redpacklist');
}
  
function request_by_fsockopen($url,$post_data=array()){
    $url_array = parse_url($url);
    $hostname = $url_array['host'];
    $port = isset($url_array['port'])? $url_array['port'] : 80; 
    $requestPath = $url_array['path'] ."?". $url_array['query'];
    $fp = fsockopen($hostname, $port, $errno, $errstr, 10);
    if (!$fp) {
        echo "$errstr ($errno)";
        return false;
    }
    $method = "GET";
    if(!empty($post_data)){
        $method = "POST";
    }
    $header = "$method $requestPath HTTP/1.1\r\n";
    $header.="Host: $hostname\r\n";
    if(!empty($post_data)){
        $_post = strval(NULL);
        foreach($post_data as $k => $v){
                $_post[]= $k."=".urlencode($v);//必须做url转码以防模拟post提交的数据中有&符而导致post参数键值对紊乱
        }
        $_post = implode('&', $_post);
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";//POST数据
        $header .= "Content-Length: ". strlen($_post) ."\r\n";//POST数据的长度
        $header.="Connection: Close\r\n\r\n";//长连接关闭
        $header .= $_post; //传递POST数据
    }else{
        $header.="Connection: Close\r\n\r\n";//长连接关闭
    }
    fwrite($fp, $header);
    fclose($fp);
}
		
		
 
	
   