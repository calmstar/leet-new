<?php
class Solution {

    /**
     * 长度最小的子数组
     * https://mp.weixin.qq.com/s/ewCRwVw0h0v4uJacYO7htQ
     给定一个含有 n 个正整数的数组和一个正整数 s ，找出该数组中满足其和 ≥ s 的长度最小的 连续 子数组，
     并返回其长度。如果不存在符合条件的子数组，返回 0。
    示例：
    输入：s = 7, nums = [2,3,1,2,4,3]
    输出：2
    解释：子数组 [4,3] 是该条件下的长度最小的子数组。
     *
     * 连续 子数组 --- 子串问题 ： 参考：/Users/starc/code/leet-new/others/backtrack-combine.php 介绍
     *
     */

    /**
     * 双指针法
     * O(n)
     * 右指针：向右前进，使窗口范围扩大，数组和 >=S
     * 左指针：向左前进，使窗口范围减少，数组和不满足时，停止左指针前进
     * @param Integer $target
     * @param Integer[] $nums
     * @return Integer
     */
    function minSubArrayLenV2 ($target, $nums)
    {
        $cou = count($nums);
        if ($cou == 0) return 0;
        $left = $right = 0;
        $minCou = $cou + 1;
        while ($right <= $cou-1) {
            // 防止一个数大于target的情况，left就会超过right，此时让right增加
            if ($left > $right) $right++;

            // 得到子数组
            $subNums = array_slice($nums, $left, $right-$left+1);
            if (array_sum($subNums) >= $target) {
                // 符合条件
                $minCou = min($minCou, count($subNums));
                $left++;
            }  else {
                $right++;
            }
        }
        return $minCou == $cou + 1 ? 0 : $minCou;
    }


    /**
     * 暴力法：超时但正确
     * O(n2)
     * @param Integer $target
     * @param Integer[] $nums
     * @return Integer
     */
    function minSubArrayLen($target, $nums) {
        $cou = count($nums);
        if ($cou == 0) return 0;
        $minCou = $cou+1;

        // 穷举连续子数组
        for ($i = 0; $i < $cou; $i++) {
            for ($j = 1; $j <= $cou-$i; $j++) { // 长度逐渐减少 $cou-$i
                // 剪枝优化: 长度大于当前最小长度就没必要继续
                if ($j >= $minCou) break;

                // 获得子数组
                $subNums = array_slice($nums, $i, $j);
                // 判断子数组
                if ( $target <= array_sum($subNums) ) {
                    $minCou = min(count($subNums), $minCou);
                }
            }
        }
        return $minCou == $cou+1 ? 0 : $minCou;
    }


}
$s = 7;
$nums = [2,3,1,2,4,3];
$res = (new Solution())->minSubArrayLen($s, $nums);
var_dump($res);