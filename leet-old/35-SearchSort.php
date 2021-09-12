<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/1/16
 * Time: 21:42
 */

/**
 * 给定一个排序数组和一个目标值，在数组中找到目标值，并返回其索引。如果目标值不存在于数组中，返回它将会被按顺序插入的位置。

你可以假设数组中无重复元素。

示例 1:

输入: [1,3,5,6], 5
输出: 2
示例 2:

输入: [1,3,5,6], 2
输出: 1
示例 3:

输入: [1,3,5,6], 7
输出: 4
示例 4:

输入: [1,3,5,6], 0
输出: 0

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/search-insert-position
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 * @param $nums
 * @param $target
 * @return int
 */
function searchInsert($nums, $target) {
    if (!$nums) return 0;

    $low = 0;
    $height = count($nums) - 1;
    while ($low <= $height) {

        // 边界情况
        if ($low == $height && $target != $nums[$height]) {
            if ($target > $nums[$height]) {
                return $height + 1;
            } else {
                return $height;
            }
        }

        $mid = (int)ceil(($low + $height) / 2);

        if ($nums[$mid] == $target) {
            return $mid;
        } elseif ($nums[$mid] > $target) {
            $height = $mid - 1;
        } else {
            $low = $mid + 1;
            if ($height < $low) return $height; // ([1,3] , 4)的数组只有两个元素时的特殊情况
        }
    }
}

var_dump(searchInsert([1,3], 4));