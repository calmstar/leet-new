<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/7/29
 * Time: 13:08
 */

// 两个有序数组a和b，得到a和b的交集。

// 暴力法 O(n的平方)
function getInter ($a, $b)
{
    $inter = [];
    foreach ($b as $v) {
        if (in_array($v, $a)) {
            $inter[] = $v;
        }
    }
    return $inter;
}

// 有序性，O(NlgN)
function getInterV2 ($a, $b)
{
    $interArr = [];
    foreach ($a as $v) {
       $res = binSearch($b, $v);
       if ($res) {
           $interArr[] = $v;
       }
    }
    return $interArr;
}
function binSearch ($arr, $target)
{
    $cou = count($arr);
    $left = 0;
    $right = $cou - 1;
    while ($left <= $right) {
        $mid = intval($left + ($left + $right) / 2);
        if ($arr[$mid] == $target) {
            return true;
        } elseif ($arr[$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }
    return false;
}


function getInterV3 ($a, $b)
{
    $interArr = [];
    $temp = 0;
    // a的元素是否在b数组里面
    foreach ($a as $av) {
        if ($temp > $av) {
            continue;
        }

        foreach ($b as $bv) {
            if ($av < $bv) {
                $temp = $bv;
                break;
            } elseif ($av == $bv) {
                $interArr[] = $bv;
            }
            // b更小的情况就继续，并且这个b的单元值就没用了
            unset($b);
        }

    }
}