<?php
class Solution {

    /**
     *
     * 与 /Users/starc/code/leet-new/SwordFinger/42-连续子数组的最大和.php 类似
     *
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

}