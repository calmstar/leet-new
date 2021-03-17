<?php

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
           if (($nums[$i] + $nums[$j]) ==$target) return [$i, $j];
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

