<?php
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
?>
<?php if($config['customcolor']){ ?>
<style>.weui_tabbar_item.weui_bar_item_on .weui_tabbar_icon,.weui_tabbar_item.weui_bar_item_on .weui_tabbar_label {
        color:<?php echo $config['customcolor'] ?>;
}</style>
<?php } ?>
<div class="weui_tabbar footer">
    <a href="plugin.php?id=xigua_114&mobile=no" class="weui_tabbar_item <?php if($_GET['ac']=='index'){echo 'weui_bar_item_on';} ?>">
        <div class="weui_tabbar_icon">
            <i class="icon iconfont icon-home<?php if($_GET['ac']=='index'){echo 'fill';} ?>"></i>
        </div>
        <p class="weui_tabbar_label"><?php x1l('index') ?></p>
    </a>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=rank" class="weui_tabbar_item  <?php if($_GET['ac']=='rank'){echo 'weui_bar_item_on';} ?>">
        <div class="weui_tabbar_icon">
            <i class="icon iconfont <?php if($_GET['ac']=='rank'){echo 'icon-huodong1';}else{echo 'icon-huodong3';} ?>"></i>
        </div>
        <p class="weui_tabbar_label"><?php x1l('rankrt') ?></p>
    </a>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=cat&city=" class="weui_tabbar_item <?php if($_GET['ac']=='cat'){echo 'weui_bar_item_on';} ?>">
        <div class="weui_tabbar_icon">
            <i class="icon iconfont icon-discover"></i>
        </div>
        <p class="weui_tabbar_label"><?php x1l('fx') ?></p>
    </a>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=join" class="weui_tabbar_item">
        <div class="weui_tabbar_icon">
            <i class="icon iconfont icon-my"></i>
        </div>
        <p class="weui_tabbar_label"><?php x1l('joind') ?></p>
    </a>
</div>
<script src="source/plugin/xigua_114/static/jquery-1.7.1.min.js?t=201403261231"></script>
<script>
$(function(){
    $(".btn").on("touchstart",function() {
        $(this)[0].classList.add('active');
        if($(this).attr('data-to')){
            return false;
        }
    }).on("touchend",function() {
        $(this)[0].classList.remove('active');
    });
});
</script>
</body>
</html>