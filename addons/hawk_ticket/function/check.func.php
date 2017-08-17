<?php
function seat_check($seats,$actid){
    if(!is_array($seats) || count($seats) < 1){
        return false;
    }
    $limitseats = getusedseats($actid);
    foreach ($seats as $k=>$v){
        if(in_array($v, $limitseats)){
            return false;
        }
    }
    return true;
}
function getusedseats($actid){
    $act = new Activity();
    $seats = $act->getlimitseats($actid);
    if(!is_array($seats) || count($seats) < 1){
        return false;
    }
    return $seats;
}