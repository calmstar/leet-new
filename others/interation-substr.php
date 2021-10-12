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

/**
 * backtrack-combine.php
 *  子串（特殊：计算公式方法不一样）（要相邻）：
 *      '' (空字符)
 *      1 2 3
 *      12  23
 *      123
 *      共 7 个子串。7 = 3(3+1)/2+1 = 7
 * 子串个数计算公式：n(n+1)/2 + 1
 * 推导思路-切割法：https://blog.csdn.net/dpj514/article/details/79048526
 */

$str = '123';
$res = getSubstr($str);
var_dump($res);