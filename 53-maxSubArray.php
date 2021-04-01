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

$nums = [-2,1,-3,4,-1,2,1,-5,4];
var_dump(maxSubArray2($nums));