<?php

/**
 * 插入排序
 * 每次从未排序区域中选择第一个数字，依次跟已排序区域的数字进行比较， 找到合适位置就进行插入 -- 不是交换
 *  从小到大排序 -- 左边为已排序好区域，右边为没有排序区域
 *
 * 时间复杂度：最好O(n)，最坏O(n2) -- 最好，都没有进入while的时候
 * 空间复杂度：O(1)
 * 稳定排序
 *
 * @param $nums
 * @return mixed
 */
function insert ($nums)
{
    $cou = count($nums);
    if ($cou < 2) return $nums;

    for ($i = 1; $i < $cou; $i++) {
        $j = $i-1; // 从要插入数字索引的上一位开始比较（即已排序区间的末尾）
        $temp = $nums[$i]; // 暂存要排序的数字
        while ($j >= 0 && $temp < $nums[$j]) { // 找到合适的插入位置，使得可以从小到大排列
            $nums[$j+1] = $nums[$j]; // 搬移数字
            $j--;
        }
        $nums[$j+1] = $temp; // 插入
    }
    return $nums;
}

$a = [1,3,2,9,5,4];
$res = insert($a);
var_dump($res);