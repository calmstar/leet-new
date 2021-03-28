<?php

/**
 *  * 给定一个排序数组和一个目标值，在数组中找到目标值，并返回其索引。
 * 如果目标值不存在于数组中，返回它将会被按顺序插入的位置。
 *
 * 输入: [1,3,5,6], 2
输出: 1
 */

/**
 *
 * 有序，考虑二分查找
 * 时间复杂度： O lgn
 * 空间复杂度： O1
 *
 * @param $nums
 * @param $target
 */
function searchInsert ($nums, $target)
{
    if (empty($nums)) return 0;
    $left = 0;
    $right = count($nums) - 1;
    while ($left < $right) {
        $mid = $left + intval(($right - $left)/2);
        if ($nums[$mid] == $target) {
            return $mid;
        } elseif ($nums[$mid] > $target) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    return $nums[$left] >= $target ? $left : $left + 1;
}

/**
 * 顺序查找法
 * 时间复杂度： O n
 * 空间复杂度：O 1
 *
 * @param $nums
 * @param $target
 * @return int|string
 */
function  searchInsert2 ($nums, $target)
{
    if (empty($nums)) return 0;
    foreach ($nums as $k => $v) {
        if ($v >= $target) {
            return $k;
        }
    }
    return count($nums);
}
