<?php

//
if (! defined ( 'IN_IA' )) {
	exit ( 'Access Denied' );
}
define ( 'XSY_WXFILE_DEBUG', false );
! defined ( 'XSY_WXFILE_PATH' ) && define ( 'XSY_WXFILE_PATH', IA_ROOT . '/addons/xsy_wxfile/' );
! defined ( 'XSY_WXFILE_INC' ) && define ( 'XSY_WXFILE_INC', XSY_WXFILE_PATH . 'inc/' );
! defined ( 'XSY_WXFILE_CORE' ) && define ( 'XSY_WXFILE_CORE', XSY_WXFILE_INC . 'core/' );
! defined ( 'XSY_WXFILE_URL' ) && define ( 'XSY_WXFILE_URL', $_W ['siteroot'] . 'addons/xsy_wxfile/' );
! defined ( 'XSY_WXFILE_STATIC' ) && define ( 'XSY_WXFILE_STATIC', XSY_WXFILE_URL . 'template/static/' );
! defined ( 'XSY_WXFILE_PREFIX' ) && define ( 'XSY_WXFILE_PREFIX', 'XSY_WXFILE_' );
! defined ( 'XSY_WXFILE_ATTACHMENT' ) && define ( 'XSY_WXFILE_ATTACHMENT', 'addons/xsy_wxfile/attachment' );
