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
$page = max(1, intval(getgpc('page')));
$lpp = 5;
$start_limit = ($page - 1) * $lpp;

include DISCUZ_ROOT . 'source/plugin/xigua_114/global.php';

$_GET = dhtmlspecialchars($_GET, ENT_QUOTES);

if(submitcheck('pushtype', 1) && FORMHASH == $_GET['formhash']){
    __deletefromcache('xigua114_cat_cache');
    if($_GET['catid'] && in_array($_GET['pushtype'], array('hot', 'new'))){
        $ret = C::t('#xigua_114#plugin_xigua114_cat')->do_pushtype($_GET['catid'], $_GET['pushtype']);
        if(!$ret){
            cpmsg(
                x1l('error', 0),
                "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page",
                'error'
            );
        }
    }
}

if(submitcheck('del', 1) && FORMHASH == $_GET['formhash']){
    __deletefromcache('xigua114_cat_cache');
    $ret = C::t('#xigua_114#plugin_xigua114_cat')->do_delete(intval($_GET['catid']));
    if($ret){
        cpmsg(
            x1l('delcat_succeed', 0),
            "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page",
            'succeed'
        );
    }else{
        cpmsg(
            x1l('delcat_error', 0),
            "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page",
            'error'
        );
    }
}
if(submitcheck('dosubmit')){
    __deletefromcache('xigua114_cat_cache');
    if($new = $_GET['n']){
        $newrow = array();
        foreach ($new['name'] as $k => $v) {
            if(is_array($v)){
                foreach ($v as $kk => $string) {
                    $newrow[] = array(
                        'pid'  => $k,
                        'name' => $string,
                        'o'    => $new['o'][$k][$kk],
                        'ts'   => time()
                    );
                }
            } else {
                $newrow[] = array(
                    'pid' => 0,
                    'name' => $v,
                    'o'  => $new['o'][$k],
                    'ts'   => time(),
                    'pos' => 'list',
                );
            }
        }
        foreach ($newrow as $new) {
            C::t('#xigua_114#plugin_xigua114_cat')->insert($new);
        }
    }

    if($_FILES['icon'] || $_FILES['adimage']){
        $icons = upload_114s($_FILES['icon']);
        $adimage = upload_114s($_FILES['adimage']);
    }
    if($r = $_GET['r']){
        foreach ($r['name'] as $cid => $name) {
            $data = array();

            $data['name']   = $name;
            $data['o']      = $r['o'][$cid];
            $data['adlink'] = $r['adlink'][$cid];
            $data['pos']    = $r['pos'][$cid];
            $data['nearby'] = $r['nearby'][$cid];
            if($_FILES['adimage']['error'][$cid] === UPLOAD_ERR_OK){
                $data['adimage']= ($adimage[$cid]['errno'] == 0 ? $adimage[$cid]['error'] : '');
            }
            if($_FILES['icon']['error'][$cid] === UPLOAD_ERR_OK) {
                $data['icon'] = ($icons[$cid]['errno'] == 0 ? $icons[$cid]['error'] : '');
            }

            C::t('#xigua_114#plugin_xigua114_cat')->update($cid, $data);
        }
    }
    if($delimg = $_GET['delimg']){
        foreach ($delimg as $catid_ => $fields_) {
            $data_ = array();
            if($fields_['icon'] == 1){
                $data_['icon'] = '';
            }
            if($fields_['adimage'] == 1){
                $data_['adimage'] = '';
            }
            if($data_){
                C::t('#xigua_114#plugin_xigua114_cat')->update($catid_, $data_);
            }
        }
    }
    cpmsg(
        x1l('succeed', 0),
        "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page",
        'succeed'
    );
}

$listinfo = C::t('#xigua_114#plugin_xigua114_cat')->fetch_all_by_page($start_limit, $lpp);
C::t('#xigua_114#plugin_xigua114_cat')->init($listinfo);
$list = C::t('#xigua_114#plugin_xigua114_cat')->get_tree_array(0);

$totalcount = C::t('#xigua_114#plugin_xigua114_cat')->count_by_page();
$multipage = multi(
    $totalcount, $lpp, $page,
    ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page"
);

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page", 'enctype');
showtips(sprintf(x1l('category_tip', 0), $_G['siteurl'] . 'plugin.php?id=xigua_114&mobile=no'));
?>
<style>
.imgi{height:20px;vertical-align:middle;cursor:pointer}.imgprevew{position:absolute;z-index:9;display:none;border:2px solid #fff;box-shadow:0 2px 1px rgba(0,0,0,0.2)}.mini{width:120px!important}.noraml{width:100px!important}.sp{position:relative;display:inline-block;background:#fff}.gray{color:orangered;font-weight:700}
.short{width:100px}
.td23 input{width:80px!important;}
</style>
<div style="height:30px;line-height:30px;padding-left:25px">
    <a href="javascript:;" onclick="show_all()"><?php echo cplang('show_all')?></a> | <a href="javascript:;" onclick="hide_all()"><?php echo cplang('hide_all')?></a>
</div>
<table class="tb tb2 ">
   <tbody>
    <tr class="header">
     <th>&nbsp;</th>
     <th><?php x1l('order')?></th>
     <th><?php x1l('cat_name')?></th>
     <th><?php x1l('cat_icon')?></th>
     <th><?php x1l('cat_ad')?></th>
     <th><?php x1l('position')?></th>
     <th><?php x1l('exit')?></th>
    </tr>
   </tbody>
<?php foreach ($list as $v) { ?>
   <tbody>
    <tr class="hover">
     <td class="td25" onclick="toggle_group('group_<?php echo $v['id']?>', $('a_group_<?php echo $v['id']?>'))"><a href="javascript:;" id="a_group_<?php echo $v['id']?>">[-]</a></td>
     <td class="td25"><input type="text" class="txt" name="r[o][<?php echo $v['id']?>]" value="<?php echo $v['o']?>" /></td>
     <td class="td23">
       <div class="parentboard"><input type="text" name="r[name][<?php echo $v['id']?>]" value="<?php echo $v['name']?>" class="txt" /></div>
     </td>
     <td>
         <input class="short" name="icon[<?php echo $v['id']?>]" type="file" />
<?php if($v['icon']){?>
 <span class="sp">
     <img class="imgi" src="<?php echo $v['icon']?>" onmouseover="$('icon<?php echo $v['id']?>').style.display='block'" onmouseout="$('icon<?php echo $v['id']?>').style.display='none'" />
     <img id="icon<?php echo $v['id']?>" src="<?php echo $v['icon']?>"  class="imgprevew" />
     <label><input type="checkbox" class="checkbox" name="delimg[<?php echo $v['id']?>][icon]" value="1" /><?php x1l('delshort')?></label>
 </span>
<?php }?>
     </td>
     <td>
         <p>
             <input class="short"  name="adimage[<?php echo $v['id']?>]" type="file" />
             <input type="text" class="txt noraml" name="r[adlink][<?php echo $v['id']?>]" value="<?php echo $v['adlink'] ? $v['adlink'] : ''; ?>" />
<?php if($v['adimage']){?>
<span class="sp">
    <img class="imgi" src="<?php echo $v['adimage']?>" onmouseover="$('ad<?php echo $v['id']?>').style.display='block'" onmouseout="$('ad<?php echo $v['id']?>').style.display='none'"  />
    <img id="ad<?php echo $v['id']?>" src="<?php echo $v['adimage']?>"  class="imgprevew" />
     <label><input type="checkbox" class="checkbox" name="delimg[<?php echo $v['id']?>][adimage]" value="1" /><?php x1l('delshort')?></label>
</span>
<?php }?>
         </p>
     </td>
    <td>
<select name="r[pos][<?php echo $v['id']?>]">
    <option <?php if($v['pos'] == 'list'){echo 'selected';}?> value="list"><?php x1l('list')?></option>
    <option <?php if($v['pos'] == 'slider'){echo 'selected';}?> value="slider"><?php x1l('slider')?></option>
    <option <?php if($v['pos'] == 'nav'){echo 'selected';}?> value="nav"><?php x1l('nav')?></option>
    <option <?php if($v['pos'] == 'near'){echo 'selected';}?> value="near"><?php x1l('near')?></option>
    <option <?php if($v['pos'] == 'bar'){echo 'selected';}?> value="bar"><?php x1l('bar')?></option>
    <option <?php if($v['pos'] == 'nil'){echo 'selected';}?> value="nil"><?php x1l('nil')?></option>
</select>
        <label><input class="checkbox" type="checkbox" name="r[nearby][<?php echo $v['id']?>]" value="1" <?php if($v['nearby']){echo 'checked';}?>><?php x1l('near')?></label>
    </td>
     <td>
         <a href="javascript:;" <?php if($v['pushtype'] == 'hot'){echo "class='gray'";}?> onclick="return _pushcat(<?php echo $v['id']?>, 'hot') "><?php x1l('hot')?></a>
         <a href="javascript:;" <?php if($v['pushtype'] == 'new'){echo "class='gray'";}?> onclick="return _pushcat(<?php echo $v['id']?>, 'new') "><?php x1l('new')?></a>
         <a href="javascript:;" onclick="return _delid(<?php echo $v['id']?>,'<?php echo str_replace('&#039;', '', $v['name'])?>') "><?php x1l('del')?></a>
     </td>
    </tr>
   </tbody>
    <tbody id="group_<?php echo $v['id']?>">
    <?php foreach ($v['child'] as $c) { ?>
        <tr class="hover">
            <td class="td25"></td>
            <td class="td25"><input type="text" class="txt" name="r[o][<?php echo $c['id']?>]" value="<?php echo $c['o']?>" /></td>
            <td class="td23">
                <div class="board">
                <input type="text" name="r[name][<?php echo $c['id']?>]" value="<?php echo $c['name']?>" class="txt" />
                </div>
            </td>
             <td>
                &nbsp;
             </td>
             <td>
                 &nbsp;
             </td>
            <td>
                <select style="visibility:hidden">
                    <option><?php x1l('slider')?></option>
                </select>
                <label><input class="checkbox" type="checkbox" name="r[nearby][<?php echo $c['id']?>]" value="1" <?php if($c['nearby']){echo 'checked';}?>><?php x1l('near')?></label>
            </td>
            <td>
             <a href="javascript:;" <?php if($c['pushtype'] == 'hot'){echo "class='gray'";}?> onclick="return _pushcat(<?php echo $c['id']?>, 'hot') "><?php x1l('hot')?></a>
             <a href="javascript:;" <?php if($c['pushtype'] == 'new'){echo "class='gray'";}?> onclick="return _pushcat(<?php echo $c['id']?>, 'new') "><?php x1l('new')?></a>
             <a href="javascript:;" onclick="return _delid(<?php echo $c['id']?>, '<?php echo str_replace('&#039;', '', $c['name'])?>') "><?php x1l('del')?></a>
            </td>
        </tr>
<?php
    }
?>
    </tbody>


   <tbody>
    <tr>
     <td></td>
     <td colspan="4">
      <div class="lastboard">
       <a href="javascript:;" onclick="addrow(this, 1, <?php echo $v['id']?>)" class="addtr"><?php x1l('ad_child_cat')?></a>
      </div></td>
     <td>&nbsp;</td>
    </tr>
   </tbody>
<?php }?>

   <tbody>
    <tr>
     <td>&nbsp;</td>
     <td colspan="99"><div>
         <a href="javascript:;" onclick="addrow(this, 0)" class="addtr"><?php x1l('ad_new_cat')?></a>
      </div></td>
    </tr>
    <?php
    if($multipage){
        showtablerow('', 'colspan="99"', $multipage);
    }
        showsubmit('dosubmit', 'submit', 'td');
    ?>
   </tbody>
  </table>
</form>
<script>
var rowtypedata = [
[
    [1, ''],
    [1,'<input type="text" class="txt" name="n[o][]" value="0" />', 'td25'],
    [5,'<div><input name="n[name][]" value="<?php x1l('new_cat_name')?>" size="20" type="text" class="txt" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)"><?php x1l('del')?></a></div>']
],
[
    [1, ''],
    [1,'<input type="text" class="txt" name="n[o][{1}][]" value="0" />', 'td25'],
    [5,'<div class="board"><input name="n[name][{1}][]" value="<?php x1l('child_cat_name')?>" size="20" type="text" class="txt" /><a href="javascript:;" class="deleterow" onClick="deleterow(this)"><?php x1l('del')?></a></div>']
]
];
function _delid(id, name){
    if(confirm('<?php x1l('del_confirm')?>' + name + '?')){
        window.location.href = "<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page&del=1&formhash=".FORMHASH.'&catid='?>"+id;
    }
}
function _pushcat(id, pushtype){
    window.location.href = "<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=cat&page=$page&formhash=".FORMHASH.'&catid='?>"+id + '&pushtype='+pushtype;
}
</script>