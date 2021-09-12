<?php

/**
 * 选择排序
 * 每次从未排序区域选择最大的数 -- 交换放在右边已排序好区域中
 *
 *
 * 最坏时间复杂度（平均）：
 *      N个数字，会选择 N 个数字，每次选择涉及到遍历比较 N 次。所以 O(N的平方)
 *
 * 最好时间复杂度：
 *      由于每次需要依次比较才能得到最大或最小的数，所以最好时间复杂度也是 O(N的平方)
 *
 * @param $arr
 * @return mixed
 */
function selectSort ($arr)
{
    $cou = count($arr);
    if ($cou < 2) return $arr;

    // 如果是六个数字，选择五次最大的数放在右边，即可。执行五组比较即可
    for ($i = 0; $i < $cou-1; $i++) {
        // 假设最大的数的索引是0
        $max = $arr[0];
        $maxIndex = 0;
        for ($j = 1; $j < $cou-$i; $j++) {
            if ($max < $arr[$j]) {
                // 选出最大的数字
                $maxIndex = $j;
                $max = $arr[$j];
            }
        }

        // 最大值的索引是否为最右边的数字
        if ($maxIndex != $cou-1-$i) {
            // 执行交换
            $temp = $arr[$maxIndex];
            $arr[$maxIndex] = $arr[$cou-1-$i];
            $arr[$cou-1-$i] = $temp;
        }
    }
    return $arr;
}

$arr = [1, 9, 5, 6, 2, 8, 23];
var_dump(selectSort($arr));