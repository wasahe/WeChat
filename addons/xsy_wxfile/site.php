<?php
/**
 * 入口文件
 * @author 折翼天使资源社区提供
 */
defined ( 'IN_IA' ) or exit ( 'Access Denied' );
require IA_ROOT . '/addons/xsy_wxfile/defines.php';
class Xsy_wxfileModuleSite extends WeModuleSite {
	
	/**
	 * 资源管理
	 */
	public function doWebManager() {
		error_reporting ( 0 );
		set_time_limit ( 0 );
		global $_W, $_GPC;
		$op = $_GPC ['op'];
		if ($op == "save") {
			$file = $_FILES ["file"];
			$filetype = $file ["type"];
			if ($filetype != 'text/plain') {
				message ( '不支持的文件格式', $this->createWebUrl ( "manager" ), 'error' );
			}
			if(strlen($file ['name'])!=30)
			{
				message ( '不支持的文件格式', $this->createWebUrl ( "manager" ), 'error' );
			}
			
			$extname = end(explode('.', $file ['name']));
			if($extname!='txt')
			{
				message ( '不支持的文件格式', $this->createWebUrl ( "manager" ), 'error' );
			}
			if (move_uploaded_file ( $file ['tmp_name'], IA_ROOT . "/" . $file ['name'] )) {
				
				$data = array (
						"uniacid" => $_W ['uniacid'],
						"name" => $file ['name'],
						"createtime" => time () 
				);
				pdo_insert ( "xsy_wxfile", $data );
				
				message ( '文件上传成功', $this->createWebUrl ( "manager" ), 'success' );
			} else {
				message ( '文件上传失败', $this->createWebUrl ( "manager" ), 'error' );
			}
		} else if ($op == 'del') {
			$wxfile = pdo_get ( "xsy_wxfile", array (
					"id" => intval ( $_GPC ['id'] ) 
			) );
			pdo_delete ( "xsy_wxfile", array (
					"id" => intval ( $_GPC ['id'] ) 
			) );
			if ($wxfile && file_exists ( IA_ROOT . "/" . $wxfile ['name'] )) {
				unlink ( IA_ROOT . "/" . $wxfile ['name'] );
			}
			
			message ( '文件删除成功', $this->createWebUrl ( "manager" ), 'success' );
		}
		if (! empty ( $name )) {
			$condition = " and name like '%" . $name . "%'";
		}
		$sql = "select * from " . tablename ( 'xsy_wxfile' ) . " where uniacid={$_W['uniacid']} {$condition} ";
		
		$count_sql = "select count(*) from " . tablename ( "xsy_wxfile" ) . " where uniacid={$_W['uniacid']} {$condition} ";
		
		$params = array ();
		$total = 0;
		$pager;
		$total_page;
		$list = array ();
		$this->get_page_data ( $sql, $count_sql, $params, $total, $pager, $list, $total_page );
		
		$resourcepath = $_W ['siteroot'] . "app/index.php?i={$_W['uniacid']}&c=entry&do=resource&m=xsy_wxfile";
		
		include $this->template ( 'web/manager' );
	}
	function get_page_data($sql, $count_sql, $params, &$total, &$pager, &$list, &$total_page = 0) {
		try {
			global $_GPC;
			$psize = 5;
			$pindex = max ( 1, intval ( $_GPC ['page'] ) );
			$total = pdo_fetchcolumn ( $count_sql, $params );
			$total_page = ($total % $psize == 0) ? $total / $psize : intval ( $total / $psize ) + 1;
			if (($pindex - 1) * $psize > $total)
				$pindex = 1;
			
			$list = pdo_fetchall ( "$sql limit " . (($pindex - 1) * $psize) . ",$psize", $params );
			$pager = pagination ( $total, $pindex, $psize );
			return false;
		} catch ( Exception $e ) {
			return $e->getMessage ();
		}
	}
}