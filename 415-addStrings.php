<?php
class Solution {

    /**
     * https://leetcode-cn.com/problems/add-strings/
     * 输入：num1 = "011", num2 = "123"
    输出："134"
     * @param String $num1
     * @param String $num2
     * @return String
     */
    function addStrings($num1, $num2)
    {
        $res = '';
        $len1 = strlen($num1);
        $len2 = strlen($num2);
        $len = max($len1, $len2);
        $zero = str_repeat('0', abs($len2 - $len1));
        if ($len1 > $len2) {
            $num2 = $zero . $num2;
        } else {
            $num1 = $zero . $num1;
        }
        $carry = 0;
        for ($i = $len - 1; $i >= 0; $i--) {
            $tempRes = intval($num1[$i]) + intval($num2[$i]) + $carry;
            $modRes = $tempRes % 10;
            $carry = $tempRes == $modRes ? 0 : 1;

            $res = $modRes . $res;
        }
        if ($carry) {
            $res = $carry . $res;
        }
        return $res;
    }
}

$a = "11";
$b = "123";
$res = (new Solution())->addStrings($a, $b);
var_dump($res);