<?php

/**
 * 基数排序 -- 基于 稳定的计数数组排序方式
 * @param $arr
 * @return mixed
 */
function radixSort($arr)
{
    $maxRank = getMaxRank($arr);
    $cou = count($arr);

    for ($i = 0; $i < $maxRank; $i++) {
        $countArr = []; // 注意每次循环都要初始化，计数数组
        $resArr = []; //结果数组

        // 依次得到个、十、百、千位...的数字
        $division = pow(10, $i);

        // 下面其实就是 稳定的计数数组排序方式 -- 如果是不稳定的计数排序，则会出错
        // 得到个位数的计数数组...
        foreach ($arr as $v) {
            $key = $v / $division % 10;
            if (isset($countArr[$key])) {
                $countArr[$key]++;
            } else {
                $countArr[$key] = 1;
            }
        }

        // $countArr 里的key顺序决定放数字的顺序。因为上面是通过foreach,所以key可能不是按照顺序来，需要先排好序
        ksort($countArr);
        // 通过个位数的计数数组，得到累加数组
        $temp = 0; // 代表上一个数的值
        foreach ($countArr as $k => $v) {
//            if (!isset($countArr[$k-1])) continue; 不能是 $k-1， 因为$k可能不是连续的（像3，4，6）
            $countArr[$k] += $temp;
            $temp = $countArr[$k];
        }

        // 按个位数字在累加数组中的位置，对整个数组进行排序
        for ($j = $cou - 1; $j >= 0; $j--) {
            $remain = $arr[$j] / $division % 10; // 得到余数
            $key = --$countArr[$remain];
            $resArr[$key] = $arr[$j];
        }
        // 需要将数组排序好，然后重新赋值给$arr
        ksort($resArr);
        $arr = $resArr;
    }
    return $resArr;
}

/**
 * 得到最大的数
 * @param $arr
 * @return int
 */
function getMaxRank($arr)
{
    $max = 0;
    foreach ($arr as $v) {
        if ($max < $v) {
            $max = $v;
        }
    }
    return strlen($max);
}


$arr = [241, 342, 531, 263];
$res = radixSort($arr);
var_dump($res);