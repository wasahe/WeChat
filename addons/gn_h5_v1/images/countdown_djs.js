<!--
var day="";
var month="";
var year="";
var s="“中秋节”";

document.write('<span id="htright" class="float_r align_r"></span>');
function show_student_time(s, FestivalDay, tag, divid){
    window.setTimeout("show_student_time('"+s+"', '"+FestivalDay+"', "+tag+")", 1000);
    BirthDay=new Date(FestivalDay);
    today=new Date();
    if(today > BirthDay){
       $('#div_'+divid).hide();
        if(divid ==9) {
            $('#div_'+divid).html('<p class="green  fz1em lh18em yy8" id="div_9"><img src="/addons/gn_h5_v1/images/TB2G5ykdM1I.eBjSszeXXc2hpXa_!!815440245.gif">新的一年已经开始了。祝你所有的小目标都能实现</p>');
        }

    }

    timeold=(BirthDay.getTime()-today.getTime());
    sectimeold=timeold/1000;
    secondsold=Math.floor(sectimeold);
    msPerDay=24*60*60*1000;
    e_daysold=timeold/msPerDay;
    daysold=Math.ceil(e_daysold);
    e_hrsold=(e_daysold-daysold)*24;
    hrsold=Math.floor(e_hrsold);
    e_minsold=(e_hrsold-hrsold)*60;
    minsold=Math.floor((e_hrsold-hrsold)*60);
    seconds=Math.floor((e_minsold-minsold)*60);
    if(tag==1){
        htright.innerHTML='距'+s+' 还有 '+daysold+'天 '+hrsold+'小时'+minsold+'分'+seconds+'秒';
    }else{
        return daysold;
    }
}
//show_student_time();

//-->