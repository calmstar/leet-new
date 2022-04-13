<?php
class Solution {

    /**
     *  https://labuladong.github.io/algo/3/24/76/
     *
     * 与 /Users/starc/code/leet-new/SwordFinger/42-连续子数组的最大和.php 类似
     * （ /Users/starc/code/leet-new/53-maxSubArray.php 最大连续子数组和 ）
     *
     * /Users/starc/code/leet-new/1143-longestCommonSubsequence.php 1143.最长公共子序列
     *
     * 最长递增子序列
     *
     * 输入：nums = [10,9,2,5,3,7,101,18]
    输出：4
    解释：最长递增子序列是 [2,3,7,101]，因此长度为 4 。
     *
     * 输入：nums = [0,1,0,3,2,3]
    输出：4
     * @param Integer[] $nums
     * @return Integer
     */
    function lengthOfLIS($nums)
    {
        if(empty($nums)) return 0;
        $cou = count($nums);
        $dp = []; // 当索引在$i时，从0位置到nums[$i]的最长递增子序列为 dp[$i]
        for ($i = 0; $i < $cou; $i++) {
            $dp[] = 1; // 初始化
            for ($j = 0; $j < $i; $j++) {
                if ($nums[$i] > $nums[$j]) {
                    $dp[$i] = max($dp[$i], $dp[$j]+1); // 每个位置的最长递增子序列依赖于前面的计算
                }
            }
        }
        return max($dp);
    }

    /**
     * 最长递增子序列
     * 动态规划：本质就是数学归纳法
     *
     * dp定义： dp[i] 代表 nums 数组在 i 位置的最长递增子序列
     * 状态转移方程：dp[i] = max(dp[0...i-1]) + 1  [while (nums[i] > nums[j])]
     *
     * @param $nums
     * @return int|mixed
     */
    function lengthOfLISV2 ($nums)
    {
        $cou = count($nums);
        if ($cou < 1) return $cou;
        $dp = [];
        $dp[0] = 1; // nums中只有一个元素时，最长递增值就是1

        for ($i = 1; $i < $cou; $i++) { // 外循环i对应dp的新索引值
            $dp[$i] = 0; // 默认赋值为0
            for ($j = 0; $j < $i; $j++) {
                if ($nums[$i] > $nums[$j]) {
                    // 依次比较，求得从 0-i-1 位置每个元素小于 nums[i] 的dp值 中的最大值
                    $dp[$i] = max($dp[$i], $dp[$j]);
                }
            }
            $dp[$i]++; // 加上i位置的元素，自增+1
        }
        return max($dp);
    }

}

