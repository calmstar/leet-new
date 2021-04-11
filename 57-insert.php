<?php

// 插入区间
function insert($intervals, $newInterval)
{
    array_push($intervals, $newInterval);
    $cou = count($intervals);
    if ($cou < 2) return $intervals;
    // 取数组的第一个元素进行排序
    $kIntervals = [];
    $keySort = [];
    foreach ($intervals as $k => $v) {
        $keySort[$k] = $v[0];
    }
    asort($keySort);
    foreach ($keySort as $k => $v) {
        $kIntervals[] = $intervals[$k];
    }

    // 对排序好的数组进行判断合并
    $res = [];
    foreach ($kIntervals as $v) {
        if (empty($res)) {
            $res[] = $v;
        }
        $last = end($res);
        if ($last[1] >= $v[0]) {
            // 可以进行合并
            array_pop($res);
            $maxLast = $v[1] > $last[1] ? $v[1] : $last[1];
            $res[] = [$last[0], $maxLast];
        } else {
            $res[] = $v;
        }
    }
    return $res;
}
$intervals = [[1,3],[6,9]];
$newInterval = [2,5];
$res = insert($intervals, $newInterval);
var_dump($res);