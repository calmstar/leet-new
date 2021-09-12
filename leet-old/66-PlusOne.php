<?php

/**
 * 给定一个由整数组成的非空数组所表示的非负整数，在该数的基础上加一。

最高位数字存放在数组的首位， 数组中每个元素只存储单个数字。

你可以假设除了整数 0 之外，这个整数不会以零开头。

示例 1:

输入: [1,2,3]
输出: [1,2,4]
解释: 输入数组表示数字 123。
示例 2:

输入: [4,3,2,1]
输出: [4,3,2,2]
解释: 输入数组表示数字 4321。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/plus-one
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */


class Solution {

    /**
     * @param Integer[] $digits
     * @return Integer[]
     */
    function plusOne($digits) {
        $cou = count($digits);
        if ($digits[$cou-1] + 1 < 10) {
            $digits[$cou-1] += 1;
        } else {

            if ($cou == 1) {
                return [1, 0];
            } else {
                $digits[$cou - 1] = 0;
            }

            $flag = 1;
            for ($i = $cou - 2; $i >= 0; $i--) {
                $temp = $digits[$i] + $flag;
                if ($temp > 9) {
                    $digits[$i] = $temp - 10;
                    if (0 == $i) {
                        array_unshift($digits, 1);
                    }
                } else {
                    $digits[$i] = $temp;
                    break;
                }
            }

        }
        return $digits;
    }
}