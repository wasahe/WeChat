<?php
defined('IN_IA') or exit('Access Denied');
function printr($var)
{
    echo "<pre>";
    print_r($var);
    exit;
}
function xdebug($log, $path = '')
{
    if (empty($path))
        $path = MODULE_ROOT . "/xdebug.log";
    file_put_contents($path, var_export($log, true) . PHP_EOL, FILE_APPEND);
}
function imgUrl($img = '')
{
    global $_W;
    if (empty($img)) {
        return "";
    }
    if (substr($img, 0, 6) == 'avatar') {
        return $_W['siteroot'] . "resource/image/avatar/" . $img;
    }
    if (substr($img, 0, 8) == './themes') {
        return $_W['siteroot'] . $img;
    }
    if (substr($img, 0, 1) == '.') {
        return $_W['siteroot'] . substr($img, 2);
    }
    if (substr($img, 0, 5) == 'http:') {
        return $img;
    }
    return $_W['attachurl'] . $img;
}
function mobileUrl($do = '', $query = NULL, $noredirect = false)
{
    global $_W, $_GPC;
    $query['do'] = $do;
    $moduleroot  = explode('/', MODULE_ROOT);
    $module      = $moduleroot[count($moduleroot) - 1];
    $query['m']  = strtolower($module);
    return $_W['siteroot'] . 'app/' . substr(murl('entry', $query, $noredirect), 2);
}
function handleText($str, $type = 0)
{
    $strlen = mb_strlen($str, 'utf-8');
    if ($type == 1) {
        if (!strpos($str, '#')) {
            if ($strlen > 3 && $strlen <= 6) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8');
            } elseif ($strlen > 6 && $strlen <= 9) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8');
            } elseif ($strlen > 9 && $strlen <= 12) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8');
            } elseif ($strlen > 12 && $strlen <= 15) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8');
            } elseif ($strlen > 15 && $strlen <= 18) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8');
            } elseif ($strlen > 18 && $strlen <= 21) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8');
            } elseif ($strlen > 21 && $strlen <= 24) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8');
            } elseif ($strlen > 24 && $strlen <= 27) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8') . "\n" . mb_substr($str, 24, 3, 'utf-8');
            } elseif ($strlen > 27 && $strlen <= 30) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8') . "\n" . mb_substr($str, 24, 3, 'utf-8') . "\n" . mb_substr($str, 27, 3, 'utf-8');
            }
        } else {
            $str = str_replace("#", "\n", $str);
        }
        $str     = mb_substr($str, 0, 30, 'utf-8');
        $textarr = explode("\n", $str);
        $str     = $textarr[0];
        if (!empty($textarr[1])) {
            $str .= "\n" . $textarr[1];
        }
        if (!empty($textarr[2])) {
            $str .= "\n" . $textarr[2];
        }
        if (!empty($textarr[3])) {
            $str .= "\n" . $textarr[3];
        }
        if (!empty($textarr[4])) {
            $str .= "\n" . $textarr[4];
        }
        if (!empty($textarr[5])) {
            $str .= "\n" . $textarr[5];
        }
        if (!empty($textarr[6])) {
            $str .= "\n" . $textarr[6];
        }
        if (!empty($textarr[7])) {
            $str .= "\n" . $textarr[7];
        }
        if (!empty($textarr[8])) {
            $str .= "\n" . $textarr[8];
        }
        if (!empty($textarr[9])) {
            $str .= "\n" . $textarr[9];
        }
    } else if ($type == 2) {
        if (!strpos($str, '#')) {
            if ($strlen > 3 && $strlen <= 6) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8');
            } elseif ($strlen > 6 && $strlen <= 9) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8');
            } elseif ($strlen > 9 && $strlen <= 12) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8');
            } elseif ($strlen > 12 && $strlen <= 15) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8');
            } elseif ($strlen > 15 && $strlen <= 18) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8');
            } elseif ($strlen > 18 && $strlen <= 21) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8');
            } elseif ($strlen > 21 && $strlen <= 24) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8');
            } elseif ($strlen > 24 && $strlen <= 27) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8') . "\n" . mb_substr($str, 24, 3, 'utf-8');
            } elseif ($strlen > 27 && $strlen <= 30) {
                $str = mb_substr($str, 0, 3, 'utf-8') . "\n" . mb_substr($str, 3, 3, 'utf-8') . "\n" . mb_substr($str, 6, 3, 'utf-8') . "\n" . mb_substr($str, 9, 3, 'utf-8') . "\n" . mb_substr($str, 12, 3, 'utf-8') . "\n" . mb_substr($str, 15, 3, 'utf-8') . "\n" . mb_substr($str, 18, 3, 'utf-8') . "\n" . mb_substr($str, 21, 3, 'utf-8') . "\n" . mb_substr($str, 24, 3, 'utf-8') . "\n" . mb_substr($str, 27, 3, 'utf-8');
            }
        } else {
            $str = str_replace("#", "\n", $str);
        }
        $str     = mb_substr($str, 0, 30, 'utf-8');
        $textarr = explode("\n", $str);
        $str     = $textarr[0];
        if (!empty($textarr[1])) {
            $str .= "\n" . $textarr[1];
        }
        if (!empty($textarr[2])) {
            $str .= "\n" . $textarr[2];
        }
        if (!empty($textarr[3])) {
            $str .= "\n" . $textarr[3];
        }
        if (!empty($textarr[4])) {
            $str .= "\n" . $textarr[4];
        }
        if (!empty($textarr[5])) {
            $str .= "\n" . $textarr[5];
        }
        if (!empty($textarr[6])) {
            $str .= "\n" . $textarr[6];
        }
        if (!empty($textarr[7])) {
            $str .= "\n" . $textarr[7];
        }
        if (!empty($textarr[8])) {
            $str .= "\n" . $textarr[8];
        }
        if (!empty($textarr[9])) {
            $str .= "\n" . $textarr[9];
        }
    } else {
        if (!strpos($str, '#')) {
            if ($strlen > 10 && $strlen <= 20) {
                $str = mb_substr($str, 0, 10, 'utf-8') . "\n" . mb_substr($str, 10, 10, 'utf-8');
            } elseif ($strlen > 20 && $strlen <= 30) {
                $str = mb_substr($str, 0, 10, 'utf-8') . "\n" . mb_substr($str, 10, 10, 'utf-8') . "\n" . mb_substr($str, 20, 10, 'utf-8');
            }
        } else {
            $str = str_replace("#", "\n", $str);
        }
        $str     = mb_substr($str, 0, 30, 'utf-8');
        $textarr = explode("\n", $str);
        $str     = $textarr[0];
        if (!empty($textarr[1])) {
            $str .= "\n" . $textarr[1];
        }
        if (!empty($textarr[2])) {
            $str .= "\n" . $textarr[2];
        }
    }
    return $str;
}
function imageCreates($bg)
{
    $bgImg = @imagecreatefromjpeg($bg);
    if (FALSE == $bgImg) {
        $bgImg = @imagecreatefrompng($bg);
    }
    if (FALSE == $bgImg) {
        $bgImg = @imagecreatefromgif($bg);
    }
    return $bgImg;
}
function imageSave($target, $path, $savefile, $config = array())
{
    global $_W, $_GPC;
    imagejpeg($target, $path[1] . $savefile);
    imagedestroy($target);
    if ($config['savetype'] >= 2) {
        load()->func('file');
        file_remote_upload($path[0] . '/' . $savefile);
        $savepath = $_W['attachurl'] . $path[0] . '/' . $savefile;
    } else if ($config['savetype'] == 1) {
        $savepath = $_W['attachurl'] . $path[0] . '/' . $savefile;
    } else {
        $savepath = MODULE_URL . $path[0] . '/' . $savefile;
    }
    return $savepath;
}
function getFilename($file, $config = array())
{
    global $_W, $_GPC;
    if ($config['savetype'] == 1) {
        $file = $_W['attachurl'] . $file;
    } else if ($config['savetype'] == 2) {
        $file = $_W['setting']['remote']['qiniu']['url'] . '/' . $file;
    } else if ($config['savetype'] == 3) {
        $file = $_W['setting']['remote']['alioss']['url'] . '/' . $file;
    } else {
        $file = tomedia($file);
    }
    return $file;
}
function imagePath($config = array())
{
    global $_W, $_GPC;
    if ($config['savetype'] >= 1) {
        $path    = 'uber_dazitu/' . date('Ym');
        $pathdir = ATTACHMENT_ROOT . '/uber_dazitu/' . date('Ym') . '/';
    } else if (empty($config['savetype']) || $config['savetype'] == 0) {
        $path    = "data/" . $_W['uniacid'];
        $pathdir = MODULE_ROOT . "/data/" . $_W['uniacid'] . "/";
    }
    if (!is_dir($pathdir)) {
        load()->func('file');
        mkdir($pathdir, 0777, true);
    }
    return array(
        $path,
        $pathdir
    );
}
function mergeImage($target, $imgurl, $data, $copy = false)
{
    $img = imageCreates($imgurl);
    $w   = imagesx($img);
    $h   = imagesy($img);
    if ($copy) {
        imagecopyresized($target, $img, $data['left'], $data['top'], 0, 0, $data['width'], $data['height'], $w, $h);
    } else {
        imagecopy($target, $img, $data['left'], $data['top'], $data['x'], $data['y'], $w, $h);
    }
    imagedestroy($img);
    return $target;
}
function mergeText($target, $text, $data, $fonts = '')
{
    $font = MODULE_ROOT . "/data/font.ttf";
    if (!empty($fonts))
        $font = $fonts;
    $text   = handleText($text, $data['type']);
    $colors = hex2rgb($data['color']);
    $color  = imagecolorallocate($target, $colors['red'], $colors['green'], $colors['blue']);
    imagettftext($target, $data['size'], 0, $data['left'], $data['top'] + $data['size'], $color, $font, $text);
    return $target;
}
function mergeTexts($target, $text, $data, $fonts = '')
{
    if (!empty($text)) {
        $font = MODULE_ROOT . "/data/font.ttf";
        if (!empty($fonts))
            $font = $fonts;
        $text        = handleText($text, $data['type']);
        $colors      = hex2rgb($data['color']);
        $color       = imagecolorallocate($target, 0, 0, 0);
        $fontsLength = mb_strlen($text, 'utf-8');
        $br_count    = substr_count($text, "\n");
        if ($data['type'] == 4) {
            if (!strpos($text, "\n")) {
                switch ($fontsLength) {
                    case 1:
                        imagettftext($target, 500, 0, 400, 720, $color, $font, $text);
                        break;
                    case 2:
                        imagettftext($target, 500, 0, 400, 720, $color, $font, $text);
                        break;
                    case 3:
                        imagettftext($target, 500, 0, 400, 720, $color, $font, $text);
                        break;
                    case 4:
                        imagettftext($target, 450, 0, 300, 720, $color, $font, $text);
                        break;
                    case 5:
                        imagettftext($target, 400, 0, 300, 700, $color, $font, $text);
                        break;
                    case 6:
                        imagettftext($target, 300, 0, 300, 650, $color, $font, $text);
                        break;
                    case 7:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 8:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 9:
                        imagettftext($target, 220, 0, 300, 600, $color, $font, $text);
                        break;
                    case 10:
                        imagettftext($target, 180, 0, 300, 580, $color, $font, $text);
                        break;
                    default:
                        imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
                }
            } elseif ($br_count == '1') {
                imagettftext($target, 180, 0, 350, 450, $color, $font, $text);
            } elseif ($br_count == '2') {
                imagettftext($target, 150, 0, 380, 300, $color, $font, $text);
            } else {
                imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
            }
        } else if ($data['type'] == 3) {
            if (!strpos($text, "\n")) {
                switch ($fontsLength) {
                    case 1:
                        imagettftext($target, 500, 0, 300, 800, $color, $font, $text);
                        break;
                    case 2:
                        imagettftext($target, 500, 0, 300, 800, $color, $font, $text);
                        break;
                    case 3:
                        imagettftext($target, 500, 0, 300, 800, $color, $font, $text);
                        break;
                    case 4:
                        imagettftext($target, 450, 0, 300, 750, $color, $font, $text);
                        break;
                    case 5:
                        imagettftext($target, 400, 0, 280, 720, $color, $font, $text);
                        break;
                    case 6:
                        imagettftext($target, 300, 0, 300, 680, $color, $font, $text);
                        break;
                    case 7:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 8:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 9:
                        imagettftext($target, 220, 0, 300, 600, $color, $font, $text);
                        break;
                    case 10:
                        imagettftext($target, 180, 0, 300, 580, $color, $font, $text);
                        break;
                    default:
                        imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
                }
            } elseif ($br_count == '1') {
                imagettftext($target, 180, 0, 300, 500, $color, $font, $text);
            } elseif ($br_count == '2') {
                imagettftext($target, 150, 0, 300, 385, $color, $font, $text);
            } else {
                imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
            }
        } else if ($data['type'] == 1) {
            if (!strpos($text, "\n")) {
                switch ($fontsLength) {
                    case 1:
                        imagettftext($target, 450, 0, 120, 520, $color, $font, $text);
                        break;
                    case 2:
                        imagettftext($target, 300, 0, 45, 440, $color, $font, $text);
                        break;
                    case 3:
                        imagettftext($target, 200, 0, 50, 400, $color, $font, $text);
                        break;
                    default:
                        imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
                }
            } elseif ($br_count == '1') {
                imagettftext($target, 200, 0, 50, 280, $color, $font, $text);
            } elseif ($br_count == '2') {
                imagettftext($target, 150, 0, 150, 210, $color, $font, $text);
            } else {
                imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
            }
        } else if ($data['type'] == 2) {
            if (!strpos($text, "\n")) {
                switch ($fontsLength) {
                    case 1:
                        imagettftext($target, 480, 0, 200, 620, $color, $font, $text);
                        break;
                    case 2:
                        imagettftext($target, 320, 0, 90, 560, $color, $font, $text);
                        break;
                    case 3:
                        imagettftext($target, 220, 0, 95, 500, $color, $font, $text);
                        break;
                    default:
                        imagettftext($target, 46, 0, 300, 175, $color, $font, $text);
                }
            } elseif ($br_count == '1') {
                imagettftext($target, 180, 0, 150, 370, $color, $font, $text);
            } elseif ($br_count == '2') {
                imagettftext($target, 150, 0, 200, 285, $color, $font, $text);
            } else {
                imagettftext($target, 46, 0, 100, 175, $color, $font, $text);
            }
        } else {
            if (!strpos($text, "\n")) {
                switch ($fontsLength) {
                    case 1:
                        imagettftext($target, 620, 0, 300, 800, $color, $font, $text);
                        break;
                    case 2:
                        imagettftext($target, 620, 0, 300, 800, $color, $font, $text);
                        break;
                    case 3:
                        imagettftext($target, 620, 0, 300, 800, $color, $font, $text);
                        break;
                    case 4:
                        imagettftext($target, 450, 0, 300, 700, $color, $font, $text);
                        break;
                    case 5:
                        imagettftext($target, 400, 0, 300, 670, $color, $font, $text);
                        break;
                    case 6:
                        imagettftext($target, 300, 0, 300, 650, $color, $font, $text);
                        break;
                    case 7:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 8:
                        imagettftext($target, 250, 0, 300, 650, $color, $font, $text);
                        break;
                    case 9:
                        imagettftext($target, 220, 0, 300, 600, $color, $font, $text);
                        break;
                    case 10:
                        imagettftext($target, 180, 0, 300, 580, $color, $font, $text);
                        break;
                    default:
                        imagettftext($target, 46, 0, 300, 175, $color, $font, $text);
                }
            } elseif ($br_count == '1') {
                imagettftext($target, 180, 0, 300, 450, $color, $font, $text);
            } elseif ($br_count == '2') {
                imagettftext($target, 180, 0, 300, 340, $color, $font, $text);
            } else {
                imagettftext($target, 46, 0, 300, 175, $color, $font, $text);
            }
        }
    }
}
function hex2rgb($colour)
{
    if ($colour[0] == '#') {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6) {
        list($r, $g, $b) = array(
            $colour[0] . $colour[1],
            $colour[2] . $colour[3],
            $colour[4] . $colour[5]
        );
    } elseif (strlen($colour) == 3) {
        list($r, $g, $b) = array(
            $colour[0] . $colour[0],
            $colour[1] . $colour[1],
            $colour[2] . $colour[2]
        );
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return array(
        'red' => $r,
        'green' => $g,
        'blue' => $b
    );
}

?>