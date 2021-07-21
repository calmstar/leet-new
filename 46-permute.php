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
//$nums = [1,2,3];
//var_dump(permute($nums));


function permuteV2 ($nums)
{
    if (empty($nums)) return [];
    $res = []; // 结果
    $tracking = [];
    backtrackingV2($res, $nums, $tracking);
    return $res;
}

function backtrackingV2 (&$res, $nums, $tracking)
{
    if (count($tracking) == count($nums)) {
        $res[] = $tracking;
        return;
    }
    foreach ($nums as $num) {
        if (in_array($num, $tracking)) continue;
        array_push($tracking, $num);
        backtrackingV2($res, $nums, $tracking);
        array_pop($tracking);
    }
}

$nums = [1,2,3];
var_dump(permuteV2($nums));