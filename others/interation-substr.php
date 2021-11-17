<?php

/**
 * 获取子串（数字相邻） --等价于 连续子数组问题
 * @param $str
 * @return mixed
 */
function getSubstr ($str)
{
    $len = strlen($str);
    if ($len == 0) return [];
    $res = [];
    for ($i = 0; $i < $len; $i++) {
        for ($j = 1; $j <= $len-$i; $j++) { // 长度变小
            $res[] = substr($str, $i, $j);
        }
    }
    return $res;
}

$str = '123';
$res = getSubstr($str);
var_dump($res);