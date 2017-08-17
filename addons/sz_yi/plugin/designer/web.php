<?php
//Ü¿ÖÚÉÌ³Ç QQ:151619143
if (!defined('IN_IA')) {
    exit('Access Denied');
}
class DesignerWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('designer');
    }
    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function api()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function menu()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}