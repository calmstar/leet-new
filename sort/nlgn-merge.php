<?php

/**
 * https://www.cnblogs.com/chengxiao/p/6194356.html
 *
 * 归并排序，从小到大进行排序
 *
 * 时间复杂度相关，看总结图
 *
 * 跟快排的区别是：
 *      快排是通过中间节点来区分大小，进行合并，在递和归两部都区分了大小
 *      归并排序一路都是无脑分开左右区间，到最终递归出口的时候才开始判断大小进行排序
 *
 * @param $nums
 * @return array
 */
function mergeSort ($nums)
{
    $cou = count($nums);
    if ($cou < 2) return $nums;

    $mid = intval($cou / 2);
    $left = array_slice($nums, 0, $mid);
    $right = array_slice($nums, $mid, $cou - $mid);

    $left = mergeSort($left); // 左边拆分完后开始分治，直到出口
    $right = mergeSort($right); // 右边拆分完毕开始分治，直到出口

    // 递归到底部，此处开始合并。
    // "分"结束，开始"治"
    return merge($left, $right);

}

function merge ($left, $right)
{
    $temp = [];
    // 将两个分别排序好的数组，进行归并
    while (count($left) && count($right)) {
        $temp[] = $left[0] < $right[0] ? array_shift($left) : array_shift($right);
    }
    // $left 或者 $right数组可能有剩余的数字
    return array_merge($temp, $left, $right);
}

$a = [1,3,2,9,5,4];
$res = mergeSort($a);
var_dump($res);