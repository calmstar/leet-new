<?php

// 组合
function combine($n, $k)
{
    $res = [];
    $temp = [];
    $begin = 0;
    backTracking ($n, $k, $res, $temp, $begin+1);
    return $res;
}

function backTracking ($n, $k, &$res, $temp, $begin)
{
    if (count($temp) == $k) {
        $res[] = $temp;
        return;
    }
    // 剪枝
    $maxIndex = $n - ($k - count($temp)) + 1;
    for ($i = $begin; $i <= $maxIndex; $i++) {
        $temp[] = $i;
        backTracking ($n, $k, $res, $temp, $i+1);
        array_pop($temp);
    }
}