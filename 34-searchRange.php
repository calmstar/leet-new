<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/M1KfTfNlu4OCK8i9PSAmug
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function searchRange($nums, $target) {
        if (empty($nums)) return [-1, -1];
        $left = $this->leftBound($nums, $target);
        $right = $this->rightBound($nums, $target);
        return [$left, $right];
    }

    function leftBound ($nums, $target)
    {
        $cou = count($nums);
        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $mid = $left + intval(($right - $left)/2);
            if ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else if ($nums[$mid] > $target) {
                $right = $mid - 1;
            } else if ($nums[$mid] == $target) {
                // 收缩右边窗口
                $right = $mid - 1;
            }
        }
        if ($left >= $cou  || $nums[$left] != $target) {
            return -1;
        }
        return $left;
    }

    function rightBound ($nums, $target)
    {
        $cou = count($nums);
        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $mid = $left + intval(($right - $left)/2);
            if ($nums[$mid] < $target) {
                $left = $mid + 1;
            } else if ($nums[$mid] > $target) {
                $right = $mid - 1;
            } else if ($nums[$mid] == $target) {
                // 收缩左边窗口
                $left = $mid + 1;
            }
        }
        if ($right < 0 || $nums[$right] != $target) {
            return -1;
        }
        return $right;
    }

}