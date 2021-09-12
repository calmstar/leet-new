<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/9
 * Time: 15:09
 */

/**
 *
 * 寻找两个有序数组的中位数
 *
 * 给定两个大小为 m 和 n 的有序数组 nums1 和 nums2。

请你找出这两个有序数组的中位数，并且要求算法的时间复杂度为 O(log(m + n))。

你可以假设 nums1 和 nums2 不会同时为空。

示例 1:

nums1 = [1, 3]
nums2 = [2]

则中位数是 2.0
示例 2:

nums1 = [1, 2]
nums2 = [3, 4]

则中位数是 (2 + 3)/2 = 2.5

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/median-of-two-sorted-arrays
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     *
     * 1 善用PHP函数
        2 将两个数组合并，然后取中间位置索引计算即可
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $arr = array_merge($nums1, $nums2); // 将两个数组进行合并.相同的key,则后面的元素会覆盖前面一个元素
        sort($arr);
        $tmp = count($arr)/2;
        $mid = (int)floor($tmp); // 索引向下取整
        $midNumber = is_int(count($arr)/2) ? ($arr[$mid] + $arr[$mid-1]) / 2 : $arr[$mid];
        return $midNumber;
    }
}
