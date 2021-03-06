<?php

/**
 * 输入：nums = [2,7,11,15], target = 9
输出：[0,1]
解释：因为 nums[0] + nums[1] == 9 ，返回 [0, 1] 。
 */

/**
 * 暴力方法
 * 时间复杂度：O n2
 * 空间复杂度： O 1
 * @param $nums
 * @param $target
 */
function towSum ($nums, $target)
{
   $count = count($nums);
   for ($i = 0; $i < $count; $i++) {
       for ($j = $i+1; $j < $count; $j++) {
           if (($nums[$i] + $nums[$j]) == $target) return [$i, $j];
       }
   }
}

/**
 * 哈希表法
 * 时间复杂度：O n
 * 空间复杂度： O n
 * @param $nums
 * @param $target
 * @return array
 */
function towSum2 ($nums, $target)
{
    $hash = [];
    foreach ($nums as $k => $v) {
        $hash[$v] = $k;
    }
    foreach ($nums as $key => $val) {
        $number = $target - $val;
        if (isset($hash[$number]) && $key != $hash[$number]) return [$key, $hash[$number]];
    }
}

