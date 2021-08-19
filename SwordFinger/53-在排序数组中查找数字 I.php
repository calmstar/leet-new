<?php

class Solution {

    /**
     * 递增数组，统计出现字数，最优，使用二分查找
     * 输入: nums = [5,7,7,8,8,10], target = 8
    输出: 2
     *
     * 二分查找，分别找到匹配的 最左边和最右边 索引值，相减即可
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target)
    {
        $leftIndex = $this->findIndex('left', $target, $nums);
        $rightIndex = $this->findIndex('right', $target, $nums);
        if ($leftIndex == -1 && $rightIndex == -1) return 0;
        if ($leftIndex == -1 || $rightIndex == -1) return 1;
        return $rightIndex-$leftIndex+1;
    }

    function findIndex ($direction, $target, $nums)
    {
        $left = 0;
        $right = count($nums) - 1;
        $resIndex = -1;
        while ($left <= $right) {
            $mid = $left + intval(($right-$left)/2);
            if ($nums[$mid] == $target) {
                // 找到目标
                // 因为存在重复的数字，所以需要继续遍历
                $resIndex = $mid;
                if ($direction == 'left') {
                    $right = $mid-1;
                } else {
                    $left = $mid+1;
                }
            } elseif ($nums[$mid] < $target) {
                // 目标在右边
                $left = $mid+1;
            } else {
                // 目标在左边
                $right = $mid - 1;
            }
        }
        return $resIndex;
    }

}
$nums = [5,7,7,8,8,10];
$target = 8;
$res = (new Solution())->search($nums, $target);
var_dump($res);



