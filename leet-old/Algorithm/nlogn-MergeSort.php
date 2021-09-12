<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/20
 * Time: 16:27
 */


/**
 * 归并思想资料：
 * https://www.bilibili.com/video/av9982752?from=search&seid=3884740761769544570
 *
 * 归并排序主程序
 * @param $arr
 * @return array
 */
function mergeSort($arr) {
    $len = count($arr);
    // 递归结束条件, 到达这步的时候, 数组就只剩下一个元素了, 也就是分离了数组
    if ($len <= 1) {
        return $arr;
    }

    $mid = intval($len / 2); // 取数组中间
    $left = array_slice($arr, 0, $mid); // 拆分数组0-mid这部分给左边left. 左开右闭
    $right = array_slice($arr, $mid); // 拆分数组mid-末尾这部分给右边right
    $left = mergeSort($left); // 左边拆分完后开始分治，直到出口
    $right = mergeSort($right); // 右边拆分完毕开始分治，直到出口
    $arr = merge($left, $right); // 开始合并两个数组

    return $arr;
}

// merge函数将两个数组($arrA, $arrB)合并并且排序好
// 分治+合并
function merge($arrA, $arrB) {
    $arrC = array();
    while (count($arrA) && count($arrB)) {
        // 这里不断的判断哪个值小, 就将小的值给到arrC, 但是到最后肯定要剩下几个值,
        // 不是剩下arrA里面的就是剩下arrB里面的而且这几个有序的值, 肯定比arrC里面所有的值都大所以使用
        $arrC[] = $arrA[0] < $arrB[0] ? array_shift($arrA) : array_shift($arrB);
    }

    return array_merge($arrC, $arrA, $arrB);
}

// 测试
$startTime = microtime(1);

$arr = range(1, 10);
shuffle($arr);

echo "before sort: ", implode(', ', $arr), "\n";
$sortArr = mergeSort($arr);
echo "after sort: ", implode(', ', $sortArr), "\n";

echo "use time: ", microtime(1) - $startTime, "s\n";