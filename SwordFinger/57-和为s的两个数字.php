<?php

class Solution {

    /**
     * 输入一个递增排序的数组和一个数字s，在数组中查找两个数，使得它们的和正好是s。如果有多对数字的和等于s，则输出任意一对即可。
    示例 1：
    输入：nums = [2,7,11,15], target = 9
    输出：[2,7] 或者 [7,2]
     * 题目限制了只有正整数
     *
     * 二分查找找到比 target 第一大的数字，然后截左半部分区间进行哈希寻找
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target)
    {
        $maxIndex = $this->findSuitIndex($nums, $target);
        if ($maxIndex < 0) return [];

        $hash = [];
        for ($i = 0; $i <= $maxIndex; $i++) {
            $val = $nums[$i];
            $hash[$val] = $i;
        }
        for ($i = 0; $i <= $maxIndex; $i++) {
            $val = $nums[$i];
            if (isset($hash[$target - $val])) {
                return [$val, $target - $val];
            }
        }
        return [];

    }

    /**
     * 找到恰好在 x<$target<y 的第一个位置，返回x索引值
     * @param $nums
     * @param $target
     * @return int
     */
    function findSuitIndex ($nums, $target)
    {
        $cou = count($nums);
        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $mid = $left + intval(($right-$left)/2);
            if ($nums[$mid] >= $target) {
                // 目标在左边
                // 全部都比目标值大
                if ($mid-1 < 0) {
                    return -1;
                }
                if ($nums[$mid-1] < $target) {
                    return $mid-1;
                }
                $right = $mid-1;
            } else {
                // 目标在右边
                // $mid已经是最后一个索引值 -- 全部都比目标值小
                if ($mid+1 >= $cou) {
                    return $mid;
                }
                // 试探右边第一个
                if ($nums[$mid+1] >= $target) {
                    return $mid;
                }
                // 继续探索
                $left = $mid+1;
            }
        }
    }
    // ：nums = [3,7,9,15], target = 9
}