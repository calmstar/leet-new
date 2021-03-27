<?php
/**
 *
 * 输入: s = "abcabcbb"
    输出: 3
    解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
 *
 * 暴力法
 * 时间复杂度为 o n2
 * @param String $s
 * @return Integer
 */
function lengthOfLongestSubstring($s)
{
    $maxLength = 0;
    $cou = strlen($s);
    for ($i = 0; $i < $cou; $i++) {
        $maxLengthTemp = 0;
        $sonStr = [];

        for ($j = $i; $j < $cou; $j++) {
            if (!in_array($s[$j], $sonStr)) {
                $sonStr[] = $s[$j];
                $maxLengthTemp++;
                if ($maxLengthTemp > $maxLength) {
                    $maxLength = $maxLengthTemp;
                }
            } else {
                break;
            }
        }
    }
    return $maxLength;
}

/**
 * 简化法 o n
 * "hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
 *
 * 上面的case解算有误
 *
 * @param $s
 */
function lengthOfLongestSubstring2($s)
{
    $maxLength = 0;
    $maxLengthTemp = 0;
    $sonStr = [];

    $len = strlen($s);
    for ($i = 0; $i < $len; $i++) {
        if (isset($sonStr[$s[$i]])) {
            // 说明前面有重复的字符了,计算这两个重复字符的长度
            $maxLengthTemp = $i - $sonStr[$s[$i]];
            // 删除上一个重复字符及之前的位置值，再重新给到最新重复字符的位置值 $i
            $index = $sonStr[$s[$i]];
            while (true) {
                $res = array_shift($sonStr);
                if ( $res === $index) break;
            }
            $sonStr[$s[$i]] = $i; // 位置值$i已经变化了
            continue;
        }
        $sonStr[$s[$i]] = $i;
        $maxLengthTemp++;
        if ($maxLengthTemp > $maxLength) {
            $aa = $sonStr;
            $maxLength = $maxLengthTemp;
        }
    }
    return implode(' ', array_keys($aa));
}



$s = "hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$res = lengthOfLongestSubstring2($s);
var_dump($res);
