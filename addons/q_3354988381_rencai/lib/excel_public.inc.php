<?php
class excel_import {
	public function __construct($titles = array(), $callrecord_list = array()) {
		header('Content-type: application/x-msexcel;charset=gbk');
		header("Content-Disposition: attachment; filename=".date('YmdHis')."_utask_money_excel.xls");
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");		
        global $_W, $_GPC;
		
		//Éú³Éexcel
		$this->xlsBOF();
		
		for($i = 0; $i < count($titles); $i++){
			$v = $titles[$i];
			$v = iconv('utf-8', 'gbk', $v);
			$this->xlsWriteLabel('0', $i, $v);
		}        
		for ($i = 0; $i < count($callrecord_list); $i++) {
			$j = 0;	
			foreach( $callrecord_list[$i] as $value){
	
					$v=$value;	
					$v = iconv('utf-8', 'gbk', $v);

				$this->xlsWriteLabel($i+1, $j, $v);
				$j++;
			}          
		} 
		$this->xlsEOF(); 		
	}


	function xlsBOF()
	{
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
		return;
	}
	function xlsEOF()
	{
		echo pack("ss", 0x0A, 0x00);
		return;
	}
	function xlsWriteLabel($Row, $Col, $Value ) { 
		$L = strlen($Value); 
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
		echo $Value; 
		return; 
	}
}
?>