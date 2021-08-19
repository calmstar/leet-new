<?php
class Solution {

    /**
     * 输入: [0,1,3]
    输出: 2
     * @param Integer[] $nums
     * @return Integer
     */
    function missingNumber($nums) {
        $cou = count($nums);
        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $mid = $left + intval(($right - $left)/2);
            if ($nums[$mid] == $mid) {
                // 说明left-mid这区间是正常的，继续探测 mid+1-right区间
                $left = $mid+1;
            } else {
                // 当前数字不正常，试探周围数字
                // 前一个正常
                if (isset($nums[$mid-1]) && $nums[$mid-1] == $mid-1) {
                    return $mid;
                }
                if (!isset($nums[$mid-1])) {
                    return $mid; // 没有前一个数字，说明只有一个元素
                }
                // 说明left-mid区间不正常，继续探测 left-mid-1
                $right = $mid-1;
            }
        }
        return $cou; // 都正常
    }
}