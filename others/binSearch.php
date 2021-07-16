<?php

function common ($nums, $target)
{
    if (empty($nums)) return -1;
    $cou = count($nums);
    $left = 0;
    $right = $cou - 1;
    while ($left <= $right)
    {
        $mid = $left + floor(($right-$left)/2);
        if ($nums[$mid] == $target) {
            return $mid;
        } elseif ($nums[$mid] > $target){
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    return -1;
}

/**
 * 二分查找最左边的数字索引
 * @param $nums
 * @param $target
 * @return false|float|int
 */
function leftBound ($nums, $target)
{
    if (empty($nums)) return -1;
    $cou = count($nums);
    $left = 0;
    $right = $cou - 1;
    while ($left <= $right)
    {
        $mid = $left + floor(($right-$left)/2);
        if ($nums[$mid] == $target) {
            $right = $mid - 1;
        } elseif ($nums[$mid] > $target){
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    if ($left >= $cou || $nums[$left] < $target ) {
        return -1;
    }
    return $left;
}

/**
 * 二分查找最左边的数字
 * @param $nums
 * @param $target
 * @return false|float|int
 */
function rightBound ($nums, $target)
{
    if (empty($nums)) return -1;
    $cou = count($nums);
    $left = 0;
    $right = $cou - 1;
    while ($left <= $right)
    {
        $mid = $left + floor(($right-$left)/2);
        if ($nums[$mid] == $target) {
            $left = $mid + 1;
        } elseif ($nums[$mid] > $target){
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    if ($right >= $cou || $nums[$right] < $target ) {
        return -1;
    }
    return $right;
}

$res = rightBound([2,2,2,6,9], 2);
var_dump($res);