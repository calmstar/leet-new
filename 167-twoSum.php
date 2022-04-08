<?php

class Solution {

    /**
     * https://mp.weixin.qq.com/s/Z-oYzx9O1pjiym6HtKqGIQ
     *
     * 数组有序，二分法，双指针法
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target) {
        $cou = count($numbers);
        if (empty($cou)) return [-1, -1];

        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $sum = $numbers[$left] + $numbers[$right];
            if ($sum == $target) {
                return [$left+1, $right+1]; //题目要求索引位置+1
            } elseif ($sum < $target) {
                $left++;
            } else {
                $right--;
            }
        }
    }

}