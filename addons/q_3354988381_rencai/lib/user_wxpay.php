<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商户充值</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <style>
        .ui-btn-jspay{
            text-decoration: none;
            border-radius: 3px;
            color: #fff;
            background-color: #5eb95e;
            font-size: 16px;
            margin: .5em 0;
            padding: .7em 1em;
            display: block;
            position: relative;
            text-align: center;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            -webkit-user-select: none;
            font-weight: 700;
            border-width: 1px;
            border-style: solid;
            border-color: #5eb95e;

        }
        .text-gray {
            padding: 20px 10px;
            color: #333;
            font-size: 12px;
        }
        .awith{
            margin-left: 30%;
            margin-right: 30%;
        }
    </style>
</head>
<body>
<br/>
<div style="text-align: center">
    <img alt="扫码支付" src="<?php echo $pay_qucode_url;?>" style="width:150px;height:150px;"/>
</div>
<div class="text-gray" style="text-align: center;font-size: 11px;">
在微信客户端中<span style="color: red;">长按二维码</span>会自动弹出识别二维码选项<br><br>
不在微信客户端中，<span style="color: red;">直接使用微信扫描二维码</span><br><br>
    或者<span style="color: red;">长按保存到手机后使用微信扫描此二维码</span>
</div>
<a class="ui-btn ui-corner-all ui-btn-jspay awith" href="javascript:history.back()">返回</a>
<?php if (0){?>
<div style="padding: 20px 0px;">
    <a class="ui-btn ui-corner-all ui-btn-jspay awith" href="">首页</a>
    <a class="ui-btn ui-corner-all ui-btn-jspay awith" href="">我的账户</a>
</div>
<?php }?>
</body>
</html>