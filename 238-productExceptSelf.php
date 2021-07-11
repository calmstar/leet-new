<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function productExceptSelf($nums) {

        // 结果数组 $res
        $res = [];
        $cou = count($nums);
        for ($i = 0; $i < $cou; $i++) {
            $res[] = 1;
        }
        // 临时存储数的变量
        $product = 1;
        // 从左边往右边，给$i位置的结果数组，赋予 $i-1的乘
        for ($i = 0;$i < $cou; $i++) {
            $res[$i] = $product;
            $product = $product * $nums[$i]; // 从左往右累乘
        }

        $product = 1;
        for ($i = $cou-1; $i >= 0; $i--) {
            $res[$i] = $product * $res[$i]; // 此时$res[$i] 已经是包含了从左往右的累乘法
            $product = $product * $nums[$i]; // // 从右往左累乘
        }
        return $res;
    }
}