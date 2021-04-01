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

$nums = [-2,1,-3,4,-1,2,1,-5,4];
var_dump(maxSubArray($nums));