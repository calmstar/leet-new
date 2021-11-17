<?php
class Solution {

    /**
     * 数组中的第K个最大元素
     * 给定整数数组 nums 和整数 k，请返回数组中第 k 个最大的元素。
    请注意，你需要找的是数组排序后的第 k 个最大的元素，而不是第 k 个不同的元素。
    示例 1:
    输入: [3,2,1,5,6,4] 和 k = 2
    输出: 5
     */

    /**
     * 暴力解法
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        if (empty($nums) || empty($k)) return 0;
        rsort($nums); // 复杂度O(nlgn)
        return $nums[$k-1];
    }

    // 分而治之，快排思想改造法
    function findKthLargestV2($nums, $k) {

    }

    // 堆法
    function findKthLargestV3 ($nums, $k) {

    }

}

$nums = [3,2,3,1,2,4,5,5,6];
$k = 4;
$res = (new Solution())->findKthLargest($nums, $k);
var_dump($res);
