<?php

/**
 * @param Integer[] $nums
 * @return void
 */
function permute($nums) {
    // 定义访问数组
    $visited = [];
    foreach ($nums as $v) {
        // 默认所有数字都未曾访问过
        $visited[$v] = false;
    }
    $res = [];
    $current = [];
    backTracking($res, $visited, $nums, $current);
    return $res;


}

function backTracking (&$res, $visited, $nums, $current)
{
    if (count($current) == count($nums)) {
        $res[] = $current;
        return;
    }
    foreach ($nums as $v) {
        // 没有访问过的元素才走这条路径
        if (!$visited[$v]) {
            $current[] = $v;
            $visited[$v] = true;
            backTracking($res, $visited, $nums, $current);
            $visited[$v] = false;
            array_pop($current);
        }
    }
}

$nums = [1,2,3];
var_dump(permute($nums));
