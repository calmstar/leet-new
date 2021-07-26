<?php
/**
 * 从小到大排序
 *
 * 选择排序
 * 每次从未排序区域选择最大的数 -- 交换放在右边已排序好区域中
 *
 * 时间复杂度：最坏&最好，O(n2)
 * 空间复杂度：O(1)
 * 非稳定排序
 *
 * 除了基数排序、计数排序、桶排序是非比较排序，其他的都是比较排序
 *
 * @param $nums
 * @return mixed
 */
function select ($nums)
{
    $cou = count($nums);
    if ($cou < 2) return $nums;

    for ($i = 0; $i < $cou; $i++) {
        // 每一轮都假设首位数字最大
        $maxIndex = 0;
        for ($j = 0; $j < $cou-$i; $j++) {
            // 选出该轮最大的数字，保存索引
            if ($nums[$maxIndex] < $nums[$j]) {
                $maxIndex = $j;
            }
        }
        // 该轮选出的最多的数字，通过索引，交换到尾部
        $temp = $nums[$maxIndex];
        $nums[$maxIndex] = $nums[$cou-$i-1];
        $nums[$cou-$i-1] = $temp;
    }
    return $nums;
}

$a = [1,3,2,9,5,4];
$res = select($a);
var_dump($res);