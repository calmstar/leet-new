<?php
/**
 * 输入：strs = ["flower","flow","flight"]
输出："fl"
 */

/**
 * 横向比较法
 * @param $strs
 */
function longestCommonPrefix($strs)
{
    if (empty($strs)) return '';
    $res = $strs[0];
    foreach ($strs as $v) {
        $len = strlen($v) > strlen($res) ? strlen($res) : strlen($v);
        $temp = '';
        for ($i = 0; $i < $len; $i++) {
            if ($v[$i] == $res[$i]) {
                $temp .= $v[$i];
            }else {
                break;
            }
        }
        $res = $temp;
    }
    return $res;
}

/**
 * 纵向比较法
 * @param $strs
 */
function longestCommonPrefix2($strs)
{
    if (empty($strs)) return '';
    $nums = count($strs);
    if ($nums == 1) return $strs[0];

    $len = strlen($strs[0]);
    $res = '';
    for ($i = 0; $i < $len; $i++) {
        for ($j = 1; $j < $nums; $j++) {
            if (!isset($strs[$j][$i])) {
                // 最短字符的位置
                break 2;
            }
            if ($strs[$j-1][$i] != $strs[$j][$i]) {
                // 有一个字符不相等，就说明不是公共字符前缀，截止
                break 2;
            }
            if ($j == $nums-1) {
                $res .= $strs[$j][$i];
            }
        }
    }
    return $res;
}