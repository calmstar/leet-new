<?php
/**
 * 无重复的最长字串
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

// -------------- 分割线 -------------

/**
 * labuladong的滑动窗口算法
 * @param $s
 * @return int|mixed
 */
function lengthOfLongestSubstring3($s)
{
   $len = strlen($s);
   if ($len < 2) return $len;

   $left = $right =0;
   $res = 0;
   $window = [];
   while ($right < $len) {
       $rTmp = $s[$right];
       $right++;
       $window[$rTmp]++;

       // 左边收缩
       while ($window[$rTmp] > 1) {
           $lTmp = $s[$left];
           $left++;
           $window[$lTmp]--;
       }
       $res = max($res, $right-$left);
   }
   return $res;
}

// 自己写的滑动窗口，核心： 左右指针滑动的时机 和 hash
function lengthOfLongestSubstringMy ($s) {
    $len = strlen($s);
    if ($len == 1 || $len == 0) return $len;

    // 窗口内的字符出现频率
    $hash = [];
    $left = $right = 0;
    $maxSize = 0;

    // 左边和右边推进的时机
    while ($right < $len) {
        $rStr = $s[$right];
        $hash[$rStr]++;

        // 如果右边刚进来的字符串，使得结果大于1，说明这个新字符导致了重复
        while ($hash[$rStr] > 1) {
            // 需要收缩左边的窗口，直到值不大于1
            $lStr = $s[$left];
            $hash[$lStr]--;
            $left++;
        }
        // 获取窗口最大值
        $maxSize = max($maxSize, $right-$left+1);
        // 扩展右边的窗口
        $right++;
    }
    return $maxSize;
}

// ------------ 分割线 -----------
/**
 * 简化法 o n
 * "hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
 * 上面的case解算有误  -- 不看
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

$s = ""; // 返回3
//$s = "hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$res = lengthOfLongestSubstring3($s);
var_dump($res);
