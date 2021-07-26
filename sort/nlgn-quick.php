<?php
/**
 * 快速排序
 *
 * N个数字，会有 lgN 轮分割（递归），每轮分割要比较 N 个数字，所以O(NloN)
 *
 * 时间复杂度：
 *      最好：O(NlgN)， 分布均匀的情况 -- 严谨的需要有数学公式证明
 *      最坏：O(N的平方)，每次选择的中间比较数字都是最大或最小的
 * 空间复杂度：
 *      递归栈占用的空间
 *      最好：O(lgN)， 递归调用lgN次。 * 额外开辟的left和right，所以是 O(N*lgN)
 *      最坏：O(N)， 递归调用N次，斜树。 * 额外开辟的left和right，所以是 O(N*N)
 *
 * 不稳定排序
 *
 * @param $arr
 * @return array
 */
function quick ($arr)
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
    return array_merge(quick($left), $midArr, quick($right));
}

$a = [1,3,2,9,5,4];
$res = quick($a);
var_dump($res);
