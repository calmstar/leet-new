<?php

/**
 * 找到某个数就返回
 * @param $nums
 * @param $target
 * @return false|float|int
 */
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
 * 二分查找最右边的数字
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

/**
 * 递归二分查找 -- 采用切割数组的方法
 * @param $num
 * @param $target
 * @return false|float|int
 */
function  recursiveBinSearch ($num, $target)
{
    if (empty($num)) return -1;

    $left = 0;
    $right = count($num) - 1;
    $mid = $left + floor( ($right-$left)/2 );
    if ($num[$mid] == $target) {
        return $mid;
    } elseif ($num[$mid] > $target) {
        // 在左边
        $leftArr = array_slice($num, 0, $mid-1);
        return recursiveBinSearch($leftArr, $target) + $mid-1;
    } else {
        // 在右边
        $rightArr = array_slice($num, $mid+1, $right-$mid);
        return recursiveBinSearch($rightArr, $target) + $mid+1;
    }
}

/**
 * 二分查找，索引拆分
 * @param $num
 * @param $target
 * @param $left 左边界
 * @param $right 右边界
 * @return false|float|int
 */
function recursiveBinSearchV2 ($num, $target, $left, $right)
{
    if ($left > $right) return -1;
    $mid = $left + floor(($right-$left)/2);
    if ($num[$mid] == $target) {
        return $mid;
    } elseif ($num[$mid] > $target) {
        // 在左边
        return recursiveBinSearchV2($num, $target, $left, $mid-1);
    } else {
        // 在右边
        return recursiveBinSearchV2($num, $target, $mid+1, $right);
    }
}

//$res = rightBound([2,2,2,6,9], 2);
$res = recursiveBinSearchV2([1,2,3,4,5], 4, 0, 4);
var_dump($res);
