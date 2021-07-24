<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function sortArrayByParityII($nums) {
        $cou = count($nums);
        if ($cou < 2) return $nums;
        // 双指针 -- 左右指针遍历交换
        $even = 0; // 偶数指针
        $odd = 1; // 奇数指针
        while ($even < $cou || $odd < $cou) {
            while (isset($nums[$odd]) && $nums[$odd] % 2 == 1) {
                // 一直跳到不为奇数的位置
                $odd = $odd + 2;
            }
            while (isset($nums[$even]) && $nums[$even] % 2 == 0) {
                // 一直跳到不为偶数的位置
                $even = $even + 2;
            }
            if (!isset($nums[$even]) || !isset($nums[$odd])) {
                break;
            }
            // 交换
            $temp = $nums[$odd];
            $nums[$odd] = $nums[$even];
            $nums[$even] = $temp;

            $odd = $odd + 2;
            $even = $even + 2;
        }
        return $nums;
    }
}