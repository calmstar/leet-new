<?php
/**
 * 冒泡排序
 * 将数字大的冒泡 -- 交换放在最右边
 * 将未排序区间的数字，依次两两比较进行冒泡，恰好将最大的数字放在了已排序的区间中
 *
 * 最坏（平均）：
 * N个数字，会有 N 轮比较，每轮会两两进行比较 N 次，然后交换到合适的位置。 所以 O(N的平方)
 *
 * 最优的情况：
 * 是进行一轮比较就够了（利用flag），所以最好时间复杂度 O(N)
 *
 * 相等时则不交换，为稳定排序。
 *
 * @param $arr
 * @return mixed
 */
function  bubbleSort ($arr)
{
    $cou = count($arr);
    if ($cou < 2) return $arr;

    // 如果是六个数字，则执行五组比较，将最大的五个数冒泡到后五位就可以了
    for ($i = 0; $i < $cou-1; $i++) {
        // 是否发生过交换，默认没有发生交换
        $flag = false;
        for ($j = 1; $j < $cou-$i; $j++) {
            // 上面的$j从1开始，所以这使用 $j-1 索引
            if ($arr[$j-1] > $arr[$j]) { // 前面一个数字比后面一个大，则进行交换
                $temp = $arr[$j];
                $arr[$j] = $arr[$j-1];
                $arr[$j-1] = $temp;
                $flag = true; // 标识改为已发生交换
            }
        }
        if (!$flag) break; // 没有发生交换
    }
    return $arr;
}

$arr = [1, 9, 5, 6, 2, 8, 23];
var_dump(bubbleSort($arr));