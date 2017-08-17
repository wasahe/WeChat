<?php
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if (!defined('IN_DISCUZ') && !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

include DISCUZ_ROOT . 'source/plugin/xigua_114/global.php';

$_GET = dhtmlspecialchars($_GET, ENT_QUOTES);
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
$page = max(1, intval(getgpc('page')));
$lpp = 20;
$start_limit = ($page - 1) * $lpp;
$xac = $_GET['xac']; 
$searchphone = trim($_GET['searchphone']);
$inaudit = $xac == 'audit';
$inreport = $xac == 'report';

$rurl =  "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=$xac&searchphone=$searchphone&page=$page";
$jsurl = ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=$xac&searchphone=$searchphone&page=$page&formhash=".FORMHASH;

include_once libfile('function/profile');
$cityhtml = showdistrict(
    array(0,0,0),
    array('resideprovince', 'residecity', 'residedist'),
    'residecitybox',
    3,
    'reside'
);


if(submitcheck('yishenhe')){
    if(C::t('#xigua_114#plugin_xigua114')->multi_update_status($_GET['yishenhe'])){
//        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}

if(submitcheck('delete')){
    if(C::t('#xigua_114#plugin_xigua114')->multi_delete($_GET['delete'])){
//        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}

if(submitcheck('addnewsubmit')){
    $addnew = $_GET['addnew'];
    $addnew['province'] = $_GET['resideprovince'];
    $addnew['city'] = $_GET['residecity'];
    $addnew['dist'] = $_GET['residedist'];
    $addnew['crts'] = time();
    $addnew['status'] = 1;

    if(!$addnew['catid']){
        cpmsg(x1l('cat_error', 0),$rurl,'error' );
    }

    $logo = upload_114($_FILES['logo']);
    $qr   = upload_114($_FILES['qr']);
    $cs   = upload_114s($_FILES['cover']);
    if($logo['errno'] == 0 && $logo['error']){
        $addnew['logo'] = $logo['error'];
    }
    if($qr['errno'] == 0 && $qr['error']){
        $addnew['qr'] = $qr['error'];
    }

    $cin = array();
    foreach ($cs as $key => $item) {
        if($item['errno'] == 0 && $item['error']){
            $cin[] = $item['error'];
        }
    }
    if($cin){
        $addnew['cover'] = implode("\t", $cin);
    }


    if(C::t('#xigua_114#plugin_xigua114')->check_phone($addnew['phone'])){
        cpmsg(x1l('company_name_exists', 0),$rurl,'error' );
    }
    if(C::t('#xigua_114#plugin_xigua114')->insert($addnew, true, false, true)){
        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}

if(submitcheck('editsubmit')){
    $editdata = $_GET['edit'];
    $id = intval($editdata['id']);
    unset($editdata['id']);
    if(!$editdata['catid']){
        cpmsg(x1l('cat_error', 0),$rurl,'error' );
    }

    $logo = upload_114($_FILES['logo']);
    $qr   = upload_114($_FILES['qr']);
    $cs   = upload_114s($_FILES['cover']);
    if($logo['errno'] == 0 && $logo['error']){
        $editdata['logo'] = $logo['error'];
    }
    if($qr['errno'] == 0 && $qr['error']){
        $editdata['qr'] = $qr['error'];
    }

    $cin = $editdata['cover'];
    foreach ($cs as $key => $item) {
        if($item['errno'] == 0 && $item['error']){
            $cin[] = $item['error'];
        }
    }
    if($cin){
        $editdata['cover'] = implode("\t", $cin);
    }
    if($editdata['del_qr']){
        $editdata['qr'] = '';
    }
    if($editdata['del_logo']){
        $editdata['logo'] = '';
    }
    if($editdata['del_cover']){
        $editdata['cover'] = '';
    }
    unset($editdata['del_logo']);
    unset($editdata['del_qr']);
    unset($editdata['del_cover']);

    if($inaudit){
        $editdata['status'] = 1;
    }

    if(C::t('#xigua_114#plugin_xigua114')->check_phone($editdata['phone'], $id)){
        cpmsg(x1l('company_name_exists', 0),$rurl,'error' );
    }

    $ret = C::t('#xigua_114#plugin_xigua114')->update($id, $editdata);
    if($ret){
        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}

if(submitcheck('persubmit')){
    if($row = $_GET['row']){
        $ret = C::t('#xigua_114#plugin_xigua114')->multi_update($row);
        if($ret){
            cpmsg(x1l('succeed', 0),$rurl,'succeed');
        }
    }
    cpmsg(x1l('error', 0),$rurl,'error');
}


if(submitcheck('delreport', 1) && FORMHASH == $_GET['formhash']){
    $ret = C::t('#xigua_114#plugin_xigua114_report')->delete(intval($_GET['reportid']));
    if($ret){
        cpmsg(x1l('del_succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('del_error', 0),$rurl,'error');
    }
}

if(submitcheck('ignorereport', 1) && FORMHASH == $_GET['formhash']){
    $ret = C::t('#xigua_114#plugin_xigua114_report')->update(intval($_GET['reportid']), array('status' => -2));
    if($ret){
        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}
if(submitcheck('doreport', 1) && FORMHASH == $_GET['formhash']){
    $ret = C::t('#xigua_114#plugin_xigua114_report')->update(intval($_GET['reportid']), array('status' => -1));
    if($ret){
        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(submitcheck('digest', 1) && FORMHASH == $_GET['formhash']){
    $digeststatus = $_GET['digeststatus'] ? '0' : '1';
    $ret = C::t('#xigua_114#plugin_xigua114')->update(intval($_GET['companyid']), array('digest' => $digeststatus));
    if($ret){
//        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(submitcheck('addv', 1) && FORMHASH == $_GET['formhash']){
    $_vstatus = $_GET['_v'] ? '0' : '1';
    $ret = C::t('#xigua_114#plugin_xigua114')->update(intval($_GET['companyid']), array('v' => $_vstatus));
    if($ret){
//        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(submitcheck('addp', 1) && FORMHASH == $_GET['formhash']){
    if(!in_array($_GET['pt'], array('hot','new','hui'))){
        $_GET['pt'] = '';
    }
    $addp = C::t('#xigua_114#plugin_xigua114')->fetch(intval($_GET['companyid']));
    if($addp['pt'] == $_GET['pt']){
        $_GET['pt'] = '';
    }

    $ret = C::t('#xigua_114#plugin_xigua114')->update(intval($_GET['companyid']), array('pt' => $_GET['pt']));
    if($ret){
//        cpmsg(x1l('succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('error', 0),$rurl,'error' );
    }
}
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(submitcheck('del', 1) && FORMHASH == $_GET['formhash']){
    $ret = C::t('#xigua_114#plugin_xigua114')->delete(intval($_GET['companyid']));
    if($ret){
        cpmsg(x1l('del_succeed', 0),$rurl,'succeed');
    }else{
        cpmsg(x1l('del_error', 0),$rurl,'error');
    }
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
$listinfo = C::t('#xigua_114#plugin_xigua114_cat')->list_all(1);
C::t('#xigua_114#plugin_xigua114_cat')->init($listinfo);
$cat_list = C::t('#xigua_114#plugin_xigua114_cat')->get_tree_array(0);
$cat = "<select name=\"\">";
$cat .= "<option value=\"0\">".x1l('none', 0)."</option>";
foreach ($cat_list as $k => $v) {
    $cat .= "<optgroup label=\"$v[name]\">";
    foreach ($v['child'] as $kk => $vv) {
        $cat .= "<option value=\"$vv[id]\">$vv[name]</option>";
    }
    $cat .= "</optgroup>";
}
$cat .= '</select>';

if($inreport){
    $list = C::t('#xigua_114#plugin_xigua114_report')->fetch_all_by_page($start_limit, $lpp);
    $reportcount = C::t('#xigua_114#plugin_xigua114_report')->count();
    $multipage = multi(
        $reportcount, $lpp, $page,
        ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=$xac&searchphone=$searchphone"
    );
}else{
    if(submitcheck('searchphone', 1) && FORMHASH == $_GET['formhash']){
        $list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_search($start_limit, $lpp, $searchphone);
        $count = C::t('#xigua_114#plugin_xigua114')->_count_search($searchphone);
    }else{
        $list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, $inaudit);
        $count = C::t('#xigua_114#plugin_xigua114')->_count($inaudit);
    }

    $multipage = multi(
        $count, $lpp, $page,
        ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=$xac&searchphone=$searchphone"
    );
}

$noticecount = $inaudit ? $count : C::t('#xigua_114#plugin_xigua114')->_count(1);
if($noticecount){
    $noticecount = "<span class=\"badge red\">$noticecount</span>";
}else{
    $noticecount = '';
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
$reportcount = C::t('#xigua_114#plugin_xigua114_report')->_count(1);
if($reportcount){
    $reportcount = "<span class=\"badge red\">$reportcount</span>";
}else{
    $reportcount = '';
}

showtips(x1l('company_manage', 0));
?>
<style>
.residebox{width:150px} .address{width:124px}.residebox select{display:inline;margin:0;width:130px}.residebox select#residecommunity{display:none}
.mini{width:25px;text-align:center}.normal{width:100px}.red{color:#fa5a35}.orange{color:coral}.green{color:forestgreen}
.xnav{margin-top:10px;height:26px;text-align:left}.xnav ul{border-radius:3px;display:inline-block;vertical-align:baseline;zoom:1;*display:inline;*vertical-align:auto}
.xnav li{float:left;border-left:1px solid #d2d2d2}.xnav li:first-child{border-left:0}.xnav li:first-child a{border-radius:3px 0 0 3px}.xnav li:last-child a{border-radius:0 3px 3px 0}
.xnav a{display:block;position:relative;padding:0 14px;height:26px;line-height:26px;font-size:11px;font-weight:bold;color:#666;text-decoration:none;background:#f5f5f5}
.xnav a:hover{color:#09C;z-index:2;background:#f0f0f0;text-decoration:none}.xnav li.active a,.xnav a:active{color:#fff;background:#666;text-decoration:none}
.xnav .badge{display:block;position:absolute;top:-12px;right:3px;line-height:16px;height:16px;padding:0 5px;color:white;border:1px solid;border-radius:10px}
.xnav .badge.red{background:#fa623f;border-color:#fa5a35}
#rsel_menu input[type="text"],#rsel_menu input[type="file"]{width:250px}#xbox{margin-bottom:5px}#rsel_menu img{vertical-align:middle;max-height:60px;max-width:220px}#residecommunity{display:none}
#rsel_menu input.short{width:77px}
.ignore{color:#aaa}.gray, .ord{color:orangered;font-weight:700}
.hasdo{color:#777}
.h26{height:26px;display:block}
.sp{position:relative;display:inline-block;background:#fff}
.imgi{max-width:30px;height:20px;vertical-align:middle;cursor:pointer}.imgprevew{position:absolute;z-index:9;display:none;border:2px solid #fff;box-shadow:0 2px 1px rgba(0,0,0,0.2);height:180px;}
#residecommunity{display:none!important;}
#residecitybox{display:inline-block}
.pg{display: inline-block!important;vertical-align:middle}
</style>
<div class="xnav">
  <ul>
    <li <?php if($xac == ''){echo 'class="active"';}?>>
        <a href="<?php echo ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage"?>"><?php x1l('nav_manage');?></a>
    </li>
    <li <?php if($inaudit){echo 'class="active"';}?>>
        <a href="<?php echo ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=audit"?>"><?php x1l('nav_waiter');echo $noticecount?></a>
    </li>
    <li <?php if($inreport){echo 'class="active"';}?>>
        <a href="<?php echo ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&xac=report"?>"><?php x1l('nav_report');echo $reportcount?></a>
    </li>
  <?php if(!$inreport){?><li><a href="javascript:;" onclick="return _add_company();" target="_blank"><?php x1l('addnew')?></a></li><?php }?>
  </ul>

<?php if($xac ==''){?>
<ul>
<li class="h26">
        <input type="text" class="txt" id="searchphone" placeholder="<?php x1l('searchlabel')?>" />
        <input type="button" class="btn" name="searchphonesubmit" onclick="_dosearchphone();" value="<?php x1l('search')?>" >
    <script>
        function _dosearchphone(){
            var stx = $('searchphone').value;
            if(!stx){
                return ;
            }
            window.location.href = "<?php echo str_replace('&page', '&xpage' , $jsurl).'&searchphone='?>"+stx;
        }
    </script>
    <?php if($searchphone){
        echo sprintf(x1l('searchresult', 0), $searchphone, $count);
    }?>
</li>
</ul>
<?php }?>
</div>
<?php
if($inreport){
    $types = array(
        1 => x1l('type1', 0),
        2 => x1l('type2', 0),
        3 => x1l('type3', 0),
    );

    showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&page=$page&xac=$xac");
    showtableheader('');
    showtablerow('class="header"', array(), array(
        x1l('report_type', 0),
        x1l('company_phone', 0),
        x1l('extra', 0),
        x1l('connect', 0),
        x1l('report_ts', 0),
        x1l('opartion', 0),
    ));

    foreach ($list as $k => $row) {
        $id = $row['id'];
        $status = $row['status'];

        $ignore = ($status == -2);
        if($status == -1){
            $tdstyle = array('class="hasdo"','class="hasdo"','class="hasdo"','class="hasdo"','class="hasdo"','class="hasdo"',);
            $opt = x1l('hasdo', 0);
        }else if($status == -2){
            $tdstyle = array('class="ignore"','class="ignore"','class="ignore"','class="ignore"','class="ignore"','class="ignore"',);
            $opt = x1l('hasignore', 0);
        }else{
            $opt = "<a href=\"javascript:;\" onclick=\"return _hasdo_report($id);\">".x1l('needdo', 0)."</a>&nbsp;<a href=\"javascript:;\" onclick=\"return _ignore_report($id);\">".x1l('ignore', 0)."</a>";
            $tdstyle = array();
        }
        $tmpurl = str_replace('&xac=report','', $jsurl);
        showtablerow('', $tdstyle,
            array(
                $types[$row['type']],
                $row['phone'] . " <a href=\"$tmpurl&page=1&searchphone=$row[phone]\">".x1l('search', 0).'</a>',
                $row['extra'],
                $row['mobile'],
                date('Y/m/d H:i:s',$row['crts']),
                "$opt&nbsp;<a href=\"javascript:;\" onclick=\"return _del_report($id);\">".x1l('del', 0)."</a>",
            ));
    }
    if($multipage){
        showtablerow('', 'colspan="99"', $multipage);
    }
    showsubmit('persubmit', 'submit');
    showtablefooter();
    showformfooter();
?>
<script>
function _ignore_report(id){
//    if(confirm('<?php //x1l('ignore_confirm_report')?>//')){
        window.location.href = "<?php echo $jsurl.'&ignorereport=1&reportid='?>"+id;
//    }
}
function _del_report(id){
//    if(confirm('<?php //x1l('del_confirm_report')?>//')){
        window.location.href = "<?php echo $jsurl.'&delreport=1&reportid='?>"+id;
//    }
}
function _hasdo_report(id){
    if(confirm('<?php x1l('do_confirm_report')?>')){
        window.location.href = "<?php echo $jsurl.'&doreport=1&reportid='?>"+id;
    }
}
</script>
<?php
}else{
$status = array(
    0 => x1l('waiter',0),
    1 => x1l('online',0),
    2 => x1l('offline',0),
);

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&page=$page&xac=$xac&searchphone=$searchphone");
showtableheader('');
showtablerow('class="header"', array(), array(
    lang('template', 'delete'),
    x1l('audit__', 0),
    x1l('order', 0),
    x1l('cat', 0),
    x1l('company_name', 0),
    x1l('phone', 0),
    x1l('address', 0),
    x1l('wechat', 0),
    x1l('applyandtime', 0),
    x1l('viewsshares', 0),
    x1l('near', 0),
    x1l('opartion', 0),
));
foreach ($list as $k => $row) {
    $id = $row['id'];
    $list[$k]['cover'] = $row['cover'] = array_filter(explode("\t",trim($row['cover'])));
    $rcos = '';
    foreach ($row['cover'] as $ke => $item) {
        $rcos .= " <span class=\"sp\">
<img class=\"imgi\" src=\"$item\" onmouseover=\"$('cer{$ke}_$id').style.display='block'\" onmouseout=\"$('cer{$ke}_$id').style.display='none'\"  />
<img id=\"cer{$ke}_$id\" src=\"$item\"  class=\"imgprevew\" />
</span>";
    }

    $cat_row = str_replace(
        array("<option value=\"$row[catid]\"", 'name=""'),
        array("<option selected value=\"$row[catid]\"", "name=\"row[$id][catid]\""),
        $cat
    );
    showtablerow('', array(
        'class="td25"',
        'class="td25"',
        'class="td25"',
        'class="td23"',
        'class=""',
        '',
        '',
        '',
        '',
        '',
        ),
    array(
        "<input type=\"checkbox\"  name=\"delete[]\" value=\"$id\" />",
        "<input type=\"checkbox\"  name=\"yishenhe[]\" value=\"$id\" ".($row['status']?'checked':'')." />",
        "<input type=\"text\" class=\"txt\" name=\"row[$id][displayorder]\" value=\"$row[displayorder]\" />",
        $cat_row,

        "<input type=\"text\" class=\"txt normal\" name=\"row[$id][company_name]\" value=\"$row[company_name]\" >".
    ($row['logo'] ? "<span class=\"sp\">
<img class=\"imgi\" src=\"$row[logo]\" onmouseover=\"$('lg$id').style.display='block'\" onmouseout=\"$('lg$id').style.display='none'\"  />
<img id=\"lg$id\" src=\"$row[logo]\"  class=\"imgprevew\" />
</span>" : '').
        ($row['qr'] ? " <span class=\"sp\">
<img class=\"imgi\" src=\"$row[qr]\" onmouseover=\"$('qr$id').style.display='block'\" onmouseout=\"$('qr$id').style.display='none'\"  />
<img id=\"qr$id\" src=\"$row[qr]\"  class=\"imgprevew\" />
</span>" : '').
        $rcos,

        "<input type=\"text\" class=\"txt normal\" name=\"row[$id][phone]\" value=\"$row[phone]\" >",

        '<div class="normal">'.$row['province'].$row['city'].$row['dist'].$row['address'] .'</div>',
        $row['wechat'],
        '<div>'.$row['realname'].'<br>'.date('Y/m/d H:i',$row['crts']).'</div>',
        ("<input type='text' style='width:40px' name='row[$id][views]' value='{$row['views']}' />".'/'."<input type='text'  style='width:40px' name='row[$id][shares]' value='{$row['shares']}' />"),
        "<input type='checkbox' class='checkbox' name='row[$id][nearby]' ".($row['nearby']?'checked':'')." value='1' />",
($xac != 'audit' ?
    "<a href='javascript:;' onclick='return _addp($id, \"new\");' ".($row['pt']=='new'?'class="ord"':'').">".x1l('mainnew',0)."</a>&nbsp;".
    "<a href='javascript:;' onclick='return _addp($id, \"hot\");' ".($row['pt']=='hot'?'class="ord"':'').">".x1l('mainhot',0)."</a>&nbsp;".
    "<a href='javascript:;' onclick='return _addp($id, \"hui\");' ".($row['pt']=='hui'?'class="ord"':'').">".x1l('mainhui',0)."</a>&nbsp;".
    "<a href='javascript:;' onclick='return _addv($id, $row[v]);' ".($row['v']?'class="ord"':'').">+V</a>&nbsp;&nbsp;".
    "<a ".($row['digest']?'class="ord"':'')." href=\"javascript:;\" onclick=\"return _digest($id, $row[digest]);\">".x1l('digest', 0)."</a>&nbsp;".
    "<a href=\"javascript:;\" onclick=\"return _show_company_profile($id);\">".x1l('profile', 0)."</a>&nbsp;" : '').
($inaudit ? "<a href=\"javascript:;\" onclick=\"return _show_company_profile($id);\">".x1l('audit', 0)."</a>&nbsp;" : '').
"<a href=\"javascript:;\" onclick=\"return _del_company($id);\">".x1l('del', 0)."</a>",
    ));
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
showsubmit('persubmit', 'submit', 'del', $multipage);
showtablefooter();
showformfooter();
?>
<div id="rsel_menu" class="custom cmain" style="display:none;width:70%;height:70%">
    <div class="cnote" style="width:100%">
        <span class="right"><a href="javascript:;" class="flbc" onclick="hideMenu();return false;"></a></span>
        <h3><?php echo $xac!='audit' ? x1l('company_profile',0): x1l('company_audit',0) ;?> - <span id="xtitle"></span></h3>
    </div>
    <div id="rsel_content" style="overflow-y:auto;height:95%">
<?php
showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&page=$page&xac=$xac&searchphone=$searchphone", 'enctype');
?>
        <table class="tb tb2 ">
            <tr class="hover">
                <td align="left" width="150"><?php x1l('cat')?></td>
                <td>
                    <?php echo str_replace(
                        array('name=""'),
                        array("name=\"edit[catid]\" id=\"xcatid\""),
                        $cat
                    );?> <span class="gray"><?php x1l('must')?></span>
                </td>
            </tr>
            <tr class="hover">
                <td align="left" width="150"><?php x1l('company_phone')?></td>
                <td><input type="text" name="edit[phone]" id="xphone" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_name_')?></td>
                <td><input type="text" name="edit[company_name]" id="xcompany_name" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_desc')?></td>
                <td>
                    <textarea cols="50" rows="5" name="edit[company_desc]" id="xcompany_desc"></textarea>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('qq')?></td>
                <td><input type="text" name="edit[qq]" id="xqq" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('wechat')?></td>
                <td><input type="text" name="edit[wechat]" id="xwechat" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('qr')?></td>
                <td>
                    <input type="file" name="qr" value="" />
                    <img src="" id="xqr">
                    <label><input type="checkbox" class="checkbox" name="edit[del_qr]" value="1" /> <?php x1l('del')?></label>
                    <label><input id="iqr" type="hidden" name="edit[qr]" value="" placeholder="<?php x1l('link')?>" /></label>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('weibo')?></td>
                <td><input type="text" name="edit[weibo]" id="xweibo" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('site')?></td>
                <td><input type="text" name="edit[site]" id="xsite" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('logo')?></td>
                <td>
                    <input type="file" name="logo" value="" />
                    <img src="" id="xlogo">
                    <label><input type="checkbox" class="checkbox" name="edit[del_logo]" value="1" /> <?php x1l('del')?></label>
                    <label><input id="ilogo" type="hidden" name="edit[logo]" value="" placeholder="<?php x1l('link')?>" /></label>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_cover_')?></td>
                <td id="cinput1">
                    <input type="file" name="cover[]" value="" />
                    <a href="javascript:;" onclick="cinput1()">+</a>
                    <label><input type="checkbox" class="checkbox" name="edit[del_cover]" value="1" /> <?php x1l('del')?></label>
                    <img src="" id="xcover">
                    <label><input id="icover" type="hidden" name="edit[cover][]" value="" placeholder="<?php x1l('link')?>" /></label>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('address_')?></td>
                <td>
                    <input class="short" type="text" name="edit[province]" id="xprovince" value="">
                    <input class="short" type="text" name="edit[city]" id="xcity" value="">
                    <input class="short" type="text" name="edit[dist]" id="xdist" value="">
                    <input class="normal" type="text" name="edit[address]" id="xaddress" value="">
                    <br><input class="normal" type="text" name="edit[lat]" id="xlat" value="">
                    <input class="normal" type="text" name="edit[lng]" id="xlng" value="">

                    <div>
                        <iframe id="mapPage" width="350" height="350" frameborder=0 src=""></iframe>
                    </div>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer')?></td>
                <td><input type="text" name="edit[realname]" id="xrealname" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer_idcard')?></td>
                <td><input type="text" name="edit[idcard]" id="xidcard" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer_mobile')?></td>
                <td><input type="text" name="edit[mobile]" id="xmobile" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="hidden" name="edit[id]" id="xid" value="0">
                    <input type="submit" class="btn" name="editsubmit" value="<?php echo $inaudit? x1l('audit__', 0) : x1l('edit',0);?>" />
                </td>
            </tr>
        </table>
<?php showformfooter();?>
    </div>
</div>

<div id="new_menu" class="custom cmain" style="display:none;width:70%;height:70%">
    <div class="cnote" style="width:100%">
        <span class="right"><a href="javascript:;" class="flbc" onclick="hideMenu();return false;"></a></span>
        <h3><?php x1l('addnew')?></h3>
    </div>
    <div id="new_content" style="overflow-y:auto;height:95%">
<?php
showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=manage&page=$page&xac=$xac&searchphone=$searchphone", 'enctype');
?>
        <table class="tb tb2 ">
            <tr class="hover">
                <td align="left" width="150"><?php x1l('cat')?></td>
                <td>
                    <?php echo str_replace(
                        array('name=""'),
                        array("name=\"addnew[catid]\" id=\"xcatid\""),
                        $cat
                    );?> <span class="gray"><?php x1l('must')?></span>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_name_')?></td>
                <td><input type="text" name="addnew[company_name]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_desc')?></td>
                <td>
                    <textarea cols="50" rows="5" name="addnew[company_desc]"></textarea>
                </td>
            </tr>
            <tr class="hover">
                <td align="left" width="150"><?php x1l('company_phone')?></td>
                <td><input type="text" name="addnew[phone]" value="" /> <span class="gray"><?php x1l('phone_union')?></span></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('qq')?></td>
                <td><input type="text" name="addnew[qq]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('wechat')?></td>
                <td><input type="text" name="addnew[wechat]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('qr')?></td>
                <td>
                    <input type="file" name="qr" value="" /> <?php x1l('or')?> <input type="text" name="addnew[qr]" value="" placeholder="<?php x1l('link')?>" />
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('weibo')?></td>
                <td><input type="text" name="addnew[weibo]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('site')?></td>
                <td><input type="text" name="addnew[site]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('logo')?></td>
                <td>
                    <input type="file" name="logo" value="" /> <?php x1l('or')?> <input type="text" name="addnew[logo]" value="" placeholder="<?php x1l('link')?>" />
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('company_cover_')?></td>
                <td id="cinput2">
                    <input type="file" name="cover[]" value="" />
                    <a onclick="cinput2();" href="javascript:;">+</a>
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('address_')?></td>
                <td>
                    <div id="residecitybox">
                        <?php echo $cityhtml;?>
                    </div>
                    <input class="normal" type="text" name="addnew[address]" value="" placeholder="<?php x1l('address_profile')?>">
                </td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer')?></td>
                <td><input type="text" name="addnew[realname]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer_idcard')?></td>
                <td><input type="text" name="addnew[idcard]" value="" /></td>
            </tr>
            <tr class="hover">
                <td align="left"><?php x1l('applyer_mobile')?></td>
                <td><input type="text" name="addnew[mobile]" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" class="btn" name="addnewsubmit" value="<?php x1l('add')?>" />
                </td>
            </tr>
        </table>
<?php showformfooter();?>
    </div>
</div>

<script>
var list = <?php
echo json_encode(aiconv2UTF8($list))?>;
function _add_company(){
    showMenu({'ctrlid':'new','evt':'click','duration':3,'pos':'00'});
    return false;
}
function _show_company_profile(id){
    var data = list[id];
    showMenu({'ctrlid':'rsel','evt':'click','duration':3,'pos':'00'});

    $('xtitle').innerHTML = data.company_name;
    var rsel_content = $('rsel_content'), content = '';
    $('xphone').value = data.phone;
    $('xqq').value = data.qq;
    $('xwechat').value = data.wechat;
    if(data.qr){
        $('xqr').src = data.qr;
        $('iqr').value = data.qr;
    }
    $('xweibo').value = data.weibo;
    $('xsite').value = data.site;
    $('xcompany_name').value = data.company_name;
    $('xcompany_desc').value = data.company_desc;
    if(data.logo){
        $('xlogo').src = data.logo;
        $('ilogo').value = data.logo;
    }
    if(data.cover){
        var html='', im = '';
        for(var i = 0; i<data.cover.length; i++){
            im = data.cover[i];
            if(i ==0){
                html += '<input type="file" name="cover[]" value="'+im+'" /> ' +
                    '<img src="'+im+'"> ' +
                    '<a href="javascript:;" onclick="cinput1()">+</a>' +
                    '<label><input type="checkbox" class="checkbox" name="edit[del_cover]" value="1" /> <?php x1l('del')?></label>'+
                    '<input type="hidden" name="edit[cover][]" value="'+im+'" />';
            }else{
                html += '<div><input type="file" name="cover[]" value="'+im+'" /> ' +
                    '<img src="'+im+'"> ' +
                    '<input type="hidden" name="edit[cover][]" value="'+im+'" /></div>';
            }
        }
        if(html){
            document.getElementById('cinput1').innerHTML = html;
        }
    }
    $('xlat').value = data.lat;
    $('xlng').value = data.lng;
    $('xaddress').value = data.address;
    $('xrealname').value = data.realname;
    $('xidcard').value = data.idcard;
    $('xmobile').value = data.mobile;
    $('xid').value = data.id;
    $('xdist').value = data.dist;
    $('xprovince').value = data.province;
    $('xcity').value = data.city;
    $('xcatid').value = data.catid;
    $('mapPage').src="http://apis.map.qq.com/tools/locpicker?search=1&type=1&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp";
    window.addEventListener('message', function(event) {
        // 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
        var loc = event.data;
        if (loc && loc.module == 'locationPicker') {//防止其他应用也会向该页面post信息，需判断module是否为'locationPicker'
            document.getElementById('xlat').value = loc.latlng.lat;
            document.getElementById('xlng').value = loc.latlng.lng;
        }
    }, false);
}
var rowtypedata = [
    [
        [1, '&nbsp;'],
        [1, 'xxx'],
        [1, '<input type="text" class="txt" style="width:100px" name="new[title][]" >'],
        [1, '<input type="text" class="txt" style="width:150px" name="new[keywords][]">'],
        [1, '<textarea  cols=20 rows=6 name="new[description][]"></textarea>'],
        [1, '<textarea  cols=20 rows=6 name="new[code][]"></textarea>'],
        [1, '&nbsp;']
    ]
];
function _del_company(id){
    if(confirm('<?php x1l('del_confirm_company')?>' + list[id].company_name + '?')){
        window.location.href = "<?php echo $jsurl.'&del=1&companyid='?>"+id;
    }
}
//function _audit_company(id){
//    if(confirm('<?php //x1l('audit_confirm_company')?>//' + list[id].company_name + '?')){
//        window.location.href = "<?php //echo $jsurl.'&audit=1&companyid='?>//"+id;
//    }
//}

function _digest(id, digest){
    window.location.href = "<?php echo $jsurl.'&digest=1&companyid='?>"+id +'&digeststatus='+digest;
}
function _addv(id, v){
    window.location.href = "<?php echo $jsurl.'&addv=1&companyid='?>"+id +'&_v='+v;
}
function _addp(id, pt){
    window.location.href = "<?php echo $jsurl.'&addp=1&companyid='?>"+id +'&pt='+pt;
}
function cinput1(){
    var input = document.createElement('input');
    input.type = 'file';
    input.name = "cover[]";
    input.style.display = "block";
    document.getElementById('cinput1').appendChild(input);
}
function cinput2(){
    var input = document.createElement('input');
    input.type = 'file';
    input.name = "cover[]";
    input.style.display = "block";
    document.getElementById('cinput2').appendChild(input);
}
</script>
<?php
}
?>