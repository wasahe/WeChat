<?php 
    //<script type="text/javascript" src="{$_W['siteroot']}app/resource/js/lib/mui.min.js"></script>
        function deal_mui_js_bug($find_js) {
            global $_W;
            if ($find_js) {
                $obj_js_html = '../app/themes/default/common/header.html';
                $js_con = file_get_contents($obj_js_html);

                if (strstr($js_con, $find_js) && !strstr($js_con, 'qwx_shangmen')) {
                    preg_match_all('/<script (.*)mui\.min\.js(.*)"><\/script>/', $js_con, $out);  
                    $find_str = $out[0][0];
                    if ($find_str) {
                        //$find_str = '<script type="text/javascript" src="{$_W[\'siteroot\']}app/resource/js/lib/mui.min.js?v=20160824"></script>';
                        $rep_str = '{if $_GET["m"] != "qwx_shangmen" || ($_GET["m"] == "qwx_shangmen" && $_GET["do"] != "cart" && $_GET["do"] != "goods")}' . $find_str . '{/if}';

                        $api_content_new = str_replace($find_str, $rep_str, $js_con);

                        $fp = fopen($obj_js_html, 'w+');
                        if (fwrite($fp, $api_content_new) === false) {
                            die('请保证文件：app/themes/default/common/header.html 有可写权限！');
                        }   
                        fclose($fp);                          
                    }
                   
                }
            }
        }	

?>