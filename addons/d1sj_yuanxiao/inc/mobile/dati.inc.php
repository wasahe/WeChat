<?php
//引用自动化
require_once dirname(__FILE__) . "/../../core/bootstrap.php";
//手机端自动化
require_once dirname(__FILE__) . "/../../core/mobilebootstrap.php";

//判断当前用户是否发起pk

// 	$only=$_GPC['only']?$_GPC['only']:'';


// 	if(!empty($only)){
// 		//修改px数据
// 		$px_list=$_GPC['only'];
	
// 	}

// 	//先判断时间是否过期
// 	$dingshi=$_GPC['dingshi'];
// 	if($_W['isajax']&&!empty($dingshi)){
// 		$openid=$_GPC['openid'];
// 		$order_no=$_GPC['order_no'];
// 		$order_res=pdo_fetchall('select count(ti_id) as dati_shu from '.tablename('d1sj_yuanxiao_correct')." where eid=:eid and openid=:openid and order_no=:order_no ",array(':eid'=>$_W['uniacid'],':openid'=>$openid,':order_no'=>$order_no));
	
// 		if($order_res){

// 			die(json_encode(array('infos'=>1,'msg'=>'时间到','ti_shuju'=>$order_res['0']['dati_shu'])));

// 		}else{
// 			die(json_encode(array('infos'=>2,'msg'=>'时间到','ti_shuju'=>0)));
			
// 		}


// 	}

// //查询对应的题库表
// $ti_id=$_GPC['ti_id'];
// if($_W['isajax']&&!empty(intval($ti_id))){
	
// 	$order_no=$_GPC['order_no'];
// 	$correct=$_GPC['da'];
// 	$only=$_GPC['only'];
// 	//答题正确插入正确数据
// 	$correct_res=pdo_fetch('select * from '.tablename('d1sj_yuanxiao_dm').' where id= '.$ti_id);

// 	$res=pdo_fetch('select * from '.tablename('d1sj_yuanxiao_correct').' where ti_id= '.$ti_id.' and order_no ='.$order_no);
// 	if(empty($res)&&$correct_res['correct']==$correct){
// 			$data=array(
// 				'ti_id'  =>$ti_id,
// 				'openid' =>$_W['openid'],
// 				'time'   =>time(),//记录最新时间段的答题记录
// 				'eid'    =>$_W['uniacid'],
// 				'order_no'=>$order_no,
// 				'only'    =>$only,
// 				);
// 			$rs=pdo_insert("d1sj_yuanxiao_correct",$data);
		
// 	}

// 	$ti_list=pdo_fetchall('select * from '.tablename('d1sj_yuanxiao_dm').' where uniacid=:uniacid and id >'.$ti_id." limit 1 ",array(':uniacid'=>$_W['uniacid']));
// 	$timu_list=array();
// 	if($ti_list){
	
// 		foreach($ti_list as $k=>$va){
// 				if($va['answer']){
// 					$answer=json_decode($va['answer'],true);
// 					$timu_list['answer'][]=array_slice($answer,0,3);

// 				}

// 		}

	
	
// 		$xia='';
// 		foreach ($ti_list as $k=> $v) {
// 				$xia.='
// 				<div class="top_bg">
// 			        <div class="score"></div>
// 			        <div style="color: transparent">1</div>
// 			        <div class="ti">

// 			            <p class="title">第'.($ti_id+1).'题</p>
// 			            <span class="ti_detail">'.$v['question'].'</span>
// 			        </div>
// 			    </div>
// 			    <input type="hidden" name="ti_id" value="'.$v['id'].'">
//         		<input type="hidden" name="correct" value="'.$v['correct'].'">
//         		<input type="hidden" name="order_no" value="'.$order_no.'"/>
//         		<input type="hidden" name="only" value="'.$only.'"/>
// 			    <div class="bottom_bg">
// 			        <h3 class="check">请选择正确的答案</h3>
// 			        <ul class="ti_list">';
// 			        foreach($timu_list["answer"] as $ka=>$va){
// 			            $xia .= '<li class="da_an" arr="'.$va['0'].'"><span>A.'.$va['0'].'</span><b></b></li>
// 			            <li class="da_an" arr="'.$va['1'].'"><span>B.'.$va['1'].'</span><b></b></li>
// 			            <li class="da_an" arr="'.$va['2'].'"><span>C.'.$va['2'].'</span><b></b></li>';
// 			        }
// 			        $xia .= '</ul>
// 			    </div>
// 			    ';
// 		}
		

	
// 		die(json_encode(array('shuju'=>1,'msg'=>'下一题','xia'=>$xia)));

// 	}else{
	
// 		$order_res=pdo_fetchall('select count(ti_id) as dati_shu from '.tablename('d1sj_yuanxiao_correct')." where eid=:eid and openid=:openid and order_no=:order_no ",array(':eid'=>$_W['uniacid'],':openid'=>$_W['openid'],':order_no'=>$order_no));
	
// 		die(json_encode(array('shuju'=>2,'msg'=>'答题结束','ti_shuju'=>$order_res['0']['dati_shu'])));
		
// 	}


// }else{
	$order_no=order();
	$ti_list=pdo_fetchall('select * from '.tablename('d1sj_yuanxiao_dm').' where uniacid=:uniacid limit 1',array(':uniacid'=>$_W['uniacid']));
	$timu_list=array();

	if(!empty($ti_list)){
		foreach($ti_list as $k=>$va){
				if($va['answer']){
					$answer=json_decode($va['answer'],true);
					
					$timu_list['answer'][]=array_slice($answer,0,3);

				}

		}

	}
	
	include $this->template($settings["themes"] . "/dati");


// }




function order(){
    //生成24位唯一订单号码，格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
      @date_default_timezone_set("PRC");
      //订购日期
      $order_date = date('Y-m-d');
      //订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
      $order_id_main = date('YmdHis') . rand(10000000,99999999);
      //订单号码主体长度
      $order_id_len = strlen($order_id_main);
      $order_id_sum = 0;
      for($i=0; $i<$order_id_len; $i++){
        $order_id_sum += (int)(substr($order_id_main,$i,1));
      }
      //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
      $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
     return $order_id;
  }
     






?>