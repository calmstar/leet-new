<?php

// 暴力法
function maxSubArray($nums) {
    $max = $nums[0];
    $cou = count($nums);

    for ($i = 0; $i < $cou; $i++) {
        $sum = $nums[$i];
        if ($sum > $max) $max = $sum;
        for ($j = $i+1; $j < $cou; $j++) {
            $sum += $nums[$j];
            if ($sum > $max) $max = $sum;
        }
        if ($sum > $max) $max = $sum;
    }
    return $max;
}

// 动态规划法: 如果前面相加的和小于0，则不进行相加
function maxSubArray2($nums)
{
    $cou = count($nums);

    for ($i = 1; $i < $cou; $i++) {
        if ($nums[$i-1] > 0) {
            // 处理后，每个都是该位置上的最大值
            $nums[$i] = $nums[$i] + $nums[$i-1];
        }
    }
    return max($nums);
}

/**
 * https://mp.weixin.qq.com/s/nrULqCsRsrPKi3Y-nUfnqg
 *
 * -2， 1 ，-3， 4
    定义：
 *      dp[i] 代表数组nums中以i为结尾的，最大子数组和
            dp[0] -2
            dp[1] 1
            dp[2] -2
            dp[3] 4
 * baseCase:
 *      i==0 dp[0] = nums[0]
 *
 * 状态转移方程
    if (dp[i-1] < 0) {
        dp[i] = nums[i]
    } else {
        dp[i] = dp[i-1] + nums[i]
    }
 *
 * @param $nums
 * @return int|mixed
 */
function maxSubArray3 ($nums)
{
    if (empty($nums)) return 0;
    $dp = [];
    $dp[0] = $nums[0];
    $cou = count($nums);
    $max = $dp[0];
    for ($i = 1; $i < $cou; $i++) {
        if ($dp[$i-1] < 0) {
            $dp[$i] = $nums[$i];
        } else {
            $dp[$i] = $dp[$i-1] + $nums[$i];
        }
        $max = max($max, $dp[$i]);
    }
    return $max;
}


$nums = [-2,1,-3,4,-1];
var_dump(xx($nums));