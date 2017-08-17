<?php
if (PHP_SAPI == 'cli') 
{
	exit('This example should only be run from a Web Browser');
}
require_once '../framework/library/phpexcel/PHPExcel.php';
if ($_GPC['op'] == 'customer') 
{
	$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid  ', array(':uniacid' => $uniacid), 'id');
	$pstatus = $this->ProcessStatus();
	$loupanid = intval($_GPC['loupan']);
	$statusid = intval($_GPC['status']);
	if (!empty($loupanid)) 
	{
		$where .= ' AND loupan=' . $loupanid . ' ';
	}
	if ($statusid < 1000) 
	{
		$where .= ' AND status=' . $statusid . ' ';
	}
	if (!empty($_GPC['outputdate'])) 
	{
		$starttime = strtotime($_GPC['outputdate']['start']);
		$endtime = strtotime($_GPC['outputdate']['end']) + (3600 * 24);
		$where .= ' AND  createtime>' . $starttime . '  AND  createtime<' . $endtime;
	}
	else 
	{
		$starttime = strtotime(date('Y-m-d', TIMESTAMP));
		$endtime = TIMESTAMP;
		$where .= ' AND  createtime>' . $starttime . '  ';
	}
	$cfg = $this->module['config'];
	$protectdate = intval($cfg['protectdate']);
	if ($protectdate) 
	{
		$protectdate = TIMESTAMP - (3600 * 24 * $protectdate);
	}
	$sql = 'SELECT *  FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE uniacid = \'' . $uniacid . '\' ' . $where . ' ORDER BY id desc ';
	$list = pdo_fetchall($sql);
	if (!empty($list)) 
	{
		$openids = '';
		foreach ($list as $l ) 
		{
			$openids = '\'' . $l['openid'] . '\'' . ',' . $openids;
		}
		$openids = '(' . trim($openids, ',') . ')';
		$members = pdo_fetchall('SELECT openid, realname, mobile,identity FROM ' . tablename('hc_deluxejjr_member') . ' WHERE openid in ' . $openids . ' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
		$member = array();
		foreach ($members as $m ) 
		{
			$member['realname'][$m['openid']] = $m['realname'];
			$member['mobile'][$m['openid']] = $m['mobile'];
			$member['identity'][$m['openid']] = $m['identity'];
			$member['mid'][$m['openid']] = $m['id'];
		}
	}
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator('Maarten Balliauw')->setLastModifiedBy('Maarten Balliauw')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('Test result file');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ID')->setCellValue('B1', '客户名')->setCellValue('C1', '手机')->setCellValue('D1', '备注')->setCellValue('E1', '所属楼盘')->setCellValue('F1', '分配时间')->setCellValue('G1', '状态')->setCellValue('H1', '预约')->setCellValue('I1', '经纪人姓名')->setCellValue('J1', '经纪人电话')->setCellValue('K1', '经纪人身份')->setCellValue('L1', '是否过期')->setCellValue('M1', '提交时间')->setCellValue('N1', '更新时间');
	$i = 2;
	foreach ($list as $row ) 
	{
		$loupanname = (($loupan[intval($row['loupan'])] ? $loupan[intval($row['loupan'])]['title'] : ''));
		$statusname = (($pstatus[intval($row['status'])] ? $pstatus[intval($row['status'])] : ''));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $row['id'])->setCellValue('B' . $i, $row['realname'])->setCellValue('C' . $i, $row['mobile'])->setCellValue('D' . $i, $row['content'])->setCellValue('E' . $i, $loupanname)->setCellValue('F' . $i, (0 < $row['allottime'] ? date('Y/m/d H:i:s', $row['allottime']) : ''))->setCellValue('G' . $i, $statusname)->setCellValue('H' . $i, ($row['flag'] == 0 ? '推荐提交' : '预约提交'))->setCellValue('I' . $i, $member['realname'][$row['openid']])->setCellValue('J' . $i, $member['mobile'][$row['openid']])->setCellValue('K' . $i, $member['identity'][$row['openid']])->setCellValue('L' . $i, ($row['updatetime'] < $protectdate ? '是' : '否'))->setCellValue('M' . $i, (0 < $row['createtime'] ? date('Y/m/d H:i:s', $row['createtime']) : ''))->setCellValue('N' . $i, (0 < $row['updatetime'] ? date('Y/m/d', $row['updatetime']) : ''));
		++$i;
	}
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
	$objPHPExcel->getActiveSheet()->setTitle(date('Y-m-d', $starttime) . '_' . date('Y-m-d', $endtime));
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="customer' . $uniacid . '_' . date('Ymd', $starttime) . '_' . date('Ymd', $endtime) . '.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit();
}
if ($_GPC['op'] == 'hc_deluxejjr') 
{
	$identity = pdo_fetchall('SELECT id,identity_name FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid  ', array(':uniacid' => $uniacid), 'id');
	if (!empty($_GPC['outputdate'])) 
	{
		$starttime = strtotime($_GPC['outputdate']['start']);
		$endtime = strtotime($_GPC['outputdate']['end']) + (3600 * 24);
		$where .= ' AND  createtime>' . $starttime . '  AND  createtime<' . $endtime;
	}
	else 
	{
		$starttime = strtotime(date('Y-m-d', TIMESTAMP));
		$endtime = TIMESTAMP;
		$where .= ' AND  createtime>' . $starttime . ' ';
	}
	$sql = 'SELECT *  FROM ' . tablename('hc_deluxejjr_member') . ' WHERE uniacid = \'' . $uniacid . '\' ' . $where . ' ORDER BY id desc ';
	$list = pdo_fetchall($sql);
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator('Maarten Balliauw')->setLastModifiedBy('Maarten Balliauw')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('Test result file');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ID')->setCellValue('B1', '姓名')->setCellValue('C1', '手机')->setCellValue('D1', '银行卡')->setCellValue('E1', '加入时间')->setCellValue('F1', '已结佣金')->setCellValue('G1', '身份');
	$i = 2;
	foreach ($list as $row ) 
	{
		$identityname = (($identity[intval($row['identity'])] ? $identity[intval($row['identity'])]['identity_name'] : ''));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $row['id'])->setCellValue('B' . $i, $row['realname'])->setCellValue('C' . $i, $row['mobile'])->setCellValue('D' . $i, $row['bankcard'])->setCellValue('E' . $i, date('Y-m-d H:i', $row['createtime']))->setCellValue('F' . $i, $row['commission'])->setCellValue('G' . $i, $identityname);
		++$i;
	}
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
	$objPHPExcel->getActiveSheet()->setTitle(date('Y-m-d', $starttime) . '_' . date('Y-m-d', $endtime));
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="customer' . $uniacid . '_' . date('Ymd', $starttime) . '_' . date('Ymd', $endtime) . '.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit();
}
?>