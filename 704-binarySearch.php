<?php


/**
 * 给定一个 n 个元素有序的（升序）整型数组 nums 和一个目标值 target  ，
 * 写一个函数搜索 nums 中的 target，如果目标值存在返回下标，否则返回 -1。

示例 1:

输入: nums = [-1,0,3,5,9,12], target = 9
输出: 4
解释: 9 出现在 nums 中并且下标为 4
 */
class Solution
{

   public function search (array $nums, int $target)
   {
       $count = count($nums);
       if (empty($count)) return -1;

       $left = 0;
       $right = $count - 1;
       while ($left <= $right) {
            $mid = $left + floor(($right - $left) / 2);
            if ($nums[$mid] < $target) {
                // 在右边
                $left = $mid + 1;
            } elseif ($nums[$mid] > $target) {
                // 在左边
                $right = $mid - 1;
            } else {
                return $mid;
            }
       }
       return -1;
   }
}
$nums = [-1,0,3,5,9,12];
$t = 9;
$res = (new Solution())->search($nums, $t);
var_dump($res);