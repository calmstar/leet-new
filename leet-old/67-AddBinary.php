<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/21
 * Time: 14:28
 */

/**
 * 给定两个二进制字符串，返回他们的和（用二进制表示）。

输入为非空字符串且只包含数字 1 和 0。

示例 1:

输入: a = "11", b = "1"
输出: "100"
示例 2:

输入: a = "1010", b = "1011"
输出: "10101"

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/add-binary
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     * @param String $a
     * @param String $b
     * @return String
     */
    function addBinary($a, $b) {
        // 不能转十进制然后转二进制 越界
        // return decbin(bindec($a) + bindec($b))

        $aCount = strlen($a);
        $bCount = strlen($b);
        $bigCount = $aCount > $bCount ? $aCount : $bCount;

        $diff = abs($aCount- $bCount);
        $add = '';
        for ($i = 0; $i < $diff; $i++) {
            $add .= 0;
        }
        // 如果a的位数长,补足b
        if ($aCount > $bCount) {
            $b = $add . $b;
        }
        // 如果b的位数长,补足a
        if ($bCount > $aCount) {
            $a = $add . $a;
        }

        $c = '';
        $flag = 0;
        // 计算公共位数长度的和
        for ($i = $bigCount - 1; $i >= 0; $i--) {
            $temp = $a[$i] + $b[$i] + $flag;
            if ($temp >= 2) {
                $c = ($temp - 2) . $c; //000
                $flag = 1; // 1
            } else {
                $c = $temp . $c;
                $flag = 0;
            }
        }
        // 如果仍然有进位
        if ($flag == 1) {
            $c = $flag . $c;
        }
        return $c;
    }
}

$s = new Solution();
$a = "1111";
$b = "1111";
// "11110"
// 10000
var_dump($s->addBinary($a, $b));
