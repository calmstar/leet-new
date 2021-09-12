<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/19
 * Time: 15:42
 */

/**
 * 快速排序
 *
 * N个数字，会有 lgN 轮分割（递归），每轮分割要比较 N 个数字，所以O(NloN)
 *
 * 最好：O(NlgN)， 分布均匀的情况
 * 最坏：O(N的平方)，每次选择的中间比较数字都是最大或最小的
 *
 * @param $arr
 * @return array
 */
function quickSort ($arr)
{
    $cou = count($arr);
    if ($cou < 2) return $arr;
    $left = $right = array();
    $mid = $arr[0];

    for ($i = 1; $i < $cou; $i++) {
        if ($arr[$i] > $mid) {
            $right[] = $arr[$i];
        } else {
            $left[] = $arr[$i];
        }
    }
    $midArr[] = $mid;
    return array_merge(quickSort($left), $midArr, quickSort($right));
}

$arr = [1, 9, 5, 6, 2, 8, 23];
var_dump(quickSort($arr));
