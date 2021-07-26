<?php
/**
 * 时间复杂度：最坏O(n2),最好O(n)
 * 空间复杂度：O（1）
 * 稳定排序（原地排序）
 * 比较排序
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
        for ($j = 0; $j < $cou-$i-1; $j++) {
            if ($nums[$j] > $nums[$j+1]) {
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