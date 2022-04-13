<?php
/**
 * 输入：strs = ["flower","flow","flight"]
输出："fl"
 */

function longestCommonPrefixMy($strs)
{
    if (empty($strs)) return '';
    $res = ''; // 最终结果
    $i = 0;
    while (true) {
        if (!isset($strs[0][$i])) break; // 第一个字符已经到末尾了
        $tmp = $strs[0][$i];
        foreach ($strs as $str) { // 依次比较出每个单词
            if ($str[$i] != $tmp) {
                break 2; //有一个字母不是任意单词的前缀，则跳出两层的循环
            }
        }
        $res .= $tmp;
        $i++;
    }
    return $res;
}


// -------------

/**
 * 横向比较法
 * @param $strs
 */
function longestCommonPrefix($strs)
{
    if (empty($strs)) return '';
    $res = $strs[0];
    foreach ($strs as $v) {
        $len = min(strlen($v), strlen($res));
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