<?php
/**
 * 易 福 源 码 网
 */
defined('IN_IA') or exit('Access Denied');

class iweite_vodsModuleProcessor extends WeModuleProcessor {
	public $modulename = 'iweite_vods';
	
	public function respond() {
		global $_W;
		$rid = $this->rule;
		$from_user= $this->message['from'];
		$keyword = $this->message['content'];
		$uniacid = $_W['uniacid'];//当前公众号ID	
		//回复用户一句话
		//////产寻当前公众号电影
		//$keyword=str_replace("电影",'',$keyword);
		if($keyword){
		$condition =" where title like '%{$keyword}%' and weid = $uniacid ";
		}else{
		$condition =" where  weid = $uniacid ";
		}
		
		
		
		
		$order_condition = " ORDER BY tid DESC LIMIT 7";
		$list = pdo_fetchall('SELECT * FROM ' . tablename($this->modulename . '_ziyuan') . $condition . $order_condition);
	
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->modulename . '_ziyuan') . $condition . $order_condition);
		
				if(empty($total)){
					return $this->respText("来晚了，资源没了，换别的名称试试吧...");
				}else{
		
				$dateArray = array();
				foreach ($list as $v=>$a) 
				{ 
				
						if (strstr($a["fpic"], 'http://')) {
							$logo =$a["fpic"];
						} else {
							$logo =$_W['siteroot'].$_W['attachurl'] .$a["fpic"];
						}
						$logo =str_replace($_W['attachurl'],'',$logo);
						
						$dateArray[] = array("title"=>$a["title"], 
								"description"=>"点此进入观看", 
								"picurl"=>$logo, 
								"url" =>$this->createMobileUrl('play', array('id'=>$a['tid']), true)
						);
				 } 
				 
				 
		return $this->respNews($dateArray);
	}	
		
	}
}