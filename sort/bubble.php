<?php
/**
 * 冒泡排序
 * 从小到大排序
 * 将数字大的冒泡 -- 交换放在最右边
 * 将未排序区间的数字，依次两两比较进行冒泡，恰好将最大的数字放在了已排序的区间中
 *
 * 时间复杂度：最坏O(n2),最好O(n) -- 通过flag判断此轮是否进行了冒泡
 * 空间复杂度：O（1）
 * 稳定排序（原地排序）-- 相等时则不交换，为稳定排序。
 *
 * 除了基数排序、计数排序、桶排序是非比较排序，其他的都是比较排序
 *
 * @param $nums
 * @return mixed
 */
function bubble ($nums)
{
    $cou = count($nums);
    if ($cou <= 1) return $nums;

    for ($i = 0; $i < $cou; $i++) {
        $isBubble = false;
        for ($j = 0; $j < $cou-$i-1; $j++) { // 因为要 $j+1，所以这里要$cou-$i-1
            if ($nums[$j] > $nums[$j+1]) {
                // 交换
                $temp = $nums[$j];
                $nums[$j] = $nums[$j+1];
                $nums[$j+1] = $temp;
                $isBubble = true;
            }
        }
        if (!$isBubble) {
            break; // 没有冒泡，说明数据都按顺序已经排列好，没必要再进行冒泡排序
        }
    }
    return $nums;
}

$a = [1,3,2,9,5,4];
$res = bubble($a);
var_dump($res);