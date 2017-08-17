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
	
	
if($ty=='display'){
	   
		load()->model('mc');
		
        $aid = 0;
		//分页start
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = '';
		if (!empty($_GPC['keyword'])) {
			$condition .= " AND CONCAT(`act_name`,`send_name`) LIKE '%{$_GPC['keyword']}%'";
		}
		$condition .= " AND gettype=3 ";
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
		include $this->template('getredpack');
}
 
		
if($ty=='ajaxrepeat'){
	//重发
	$id=trim($_GPC['id']);
	$lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE id=:id AND aid = :aid AND uniacid = :uniacid  AND isdel=0 ", array(':aid' => 0,':uniacid' => $uniacid,'id'=>$id));

	if(!empty($lickylog['tid'])&& $lickylog['result_code']!='SUCCESS'){     //第一次执行发红包动作&&红包发送不成功时，再执行多次执行，后台可以看到错误结果
	    if($lickylog['gettype']==3){
			$url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack');
			$senddata=array(
				'openid'=>$lickylog['re_openid'],
				'local'=>2,
				'id'=>$id,
			);
		}else{
			$url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack',array('tid'=>$lickylog['tid'],'tokenkey'=>trim(base64_encode($redata['openid']))));
	        //异步发红包start
			//$this->doRequest($url);
			$senddata=array(
			    'openid'=>$lickylog['re_openid'],
				'local '=>1,
			);
			
		}
	
	        
        $this->sendredpackt($lickylog['re_openid'],$senddata,$id);

		message('成功提交请求','', 'success');
			
			
	}
}		
		
	
   