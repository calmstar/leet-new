<?php
// 超过11位会转为科学技术法
function plusOne($digits)
{
    $cou = count($digits);
    if ($cou < 1) return $digits;
    $num = '';
    foreach ($digits as $v) {
        $num .= $v;
    }
    $num = (string)$num+(string)1;
    var_dump($num);exit;


    $len = strlen($num);
    for ($i = 0; $i < $len; $i++) {
        $digits[$i] = $num[$i];
    }
    return $digits;
}

function plusOne2 ($digits)
{
    $cou = count($digits);
    if ($cou < 1) return $digits;
    $flag = false;
    for ($i = $cou-1; $i >=0; $i--) {
        if ($digits[$i] == 9) {
            $flag = true;
            $digits[$i] = 0;
        } else {
            $digits[$i]++;
            $flag = false;
            break;
        }
    }
    if ($flag) {
        array_unshift($digits, 1);
    }
    return $digits;
}

$digits = [7,2,8,5,0,9,1,2,9,5,3,6,6,7,3,2,8,4,3,7,9,5,7,7,4,7,4,9,4,7,0,1,1,1,7,4,0,0,6];
$res = plusOne2($digits);
var_dump($res);