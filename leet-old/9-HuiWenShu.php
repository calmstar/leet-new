<?php
/**
 * 判断回文数
 *
 * 判断一个整数是否是回文数。回文数是指正序（从左向右）和倒序（从右向左）读都是一样的整数。

示例 1:

输入: 121
输出: true
示例 2:

输入: -121
输出: false
解释: 从左向右读, 为 -121 。 从右向左读, 为 121- 。因此它不是一个回文数。
示例 3:

输入: 10
输出: false
解释: 从右向左读, 为 01 。因此它不是一个回文数。
进阶:

你能不将整数转为字符串来解决这个问题吗？

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/palindrome-number
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 * @param $x
 * @return bool
 */
function isPalindrome($x) {
    if ($x < 0) return false;

    $xStr = (string)$x;
    $reverStr = '';
    $length = strlen($xStr);

    for ($i = $length-1; $i >= 0; $i--) {
        $reverStr .= $xStr[$i];
    }

    if ($reverStr == $x) {
        return true;
    } else {
        return false;
    }
}

var_dump(isPalindrome(-121));


/**
 * 双指针法
 * @param $x
 * @return bool
 */
function isPalindromeTwo($x) {
    $len = strlen($x);
    if ($len < 2) return true;
    $halfLen = intval($len/2); // 向下取整
    $x = (string)$x;
    for ($i = 0; $i < $halfLen; $i++) {
        if ($x[$i] != $x[$len-$i-1]) {
            return false;
        }
    }
    return true;
}
$a = -121;
$res = isPalindromeTwo($a);
var_dump($res);
