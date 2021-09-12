<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/1/16
 * Time: 21:29
 */

/**
 * 二分查找
 * @param $arr
 * @param $target
 * @return int
 */
function binSearch ($arr, $target)
{
    $num = count($arr);
    if (!$num) return -1;

    $low = 0;
    $heigh = $num - 1;
    // 当low 都大于 height 时，就跳出了循环
    while ($low <= $heigh) {
        // 使用ceil，进一法。因为low和height用的是数组索引，比真实长度少1
        $mid = (int)ceil(($low + $heigh) / 2);
        if ($arr[$mid] == $target) {
            return $mid;
        } elseif ($arr[$mid] > $target) {
            $heigh = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }
    return -1;
}

var_dump(binSearch([1,2,3,6,8,9], 9));