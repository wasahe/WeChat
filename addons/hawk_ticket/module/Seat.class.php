<?php
class Seat
{
    private $Table_seat = 'hticket_seat';

    public function create($entity)
    {
        global $_W;
        $input = array_elements(array('orid', 'price', 'nums', 'seats', 'ptime'), $entity);
        $input['uniacid'] = $_W['uniacid'];
        $input['createtime'] = TIMESTAMP;
        $input['openid'] = $_W['fans']['from_user'];
        if (empty($input['openid'])) {
            return false;
        }
        $ret = pdo_insert($this->Table_seat, $input);
        if (!empty($ret)) {
            $id = pdo_insertid();
            return $id;
        }
        return false;
    }

    public function getOne($orid){
        global $_W;
        if(empty($orid)){
            return false;
        }
        $params = array();
        $condition = " `uniacid`=:uniacid  AND `orid`=:orid ";
        $params[':uniacid'] = $_W['uniacid'];
        $params[':orid'] = $orid;
        $sql = "SELECT * FROM ".tablename($this->Table_seat)." WHERE {$condition} ";
        $res=pdo_fetch($sql,$params);
        if($res){
            $res['seats']=unserialize(base64_decode($res['seats']));
            $res['seats'] = implode(",",$res['seats']);
            return $res;
        }
        return false;
    }

}