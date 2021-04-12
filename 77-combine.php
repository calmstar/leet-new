<?php

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

    for ($i = $begin; $i <= $n; $i++) {
        $temp[] = $i;
        backTracking ($n, $k, $res, $temp, $i+1);
        array_pop($temp);
    }
}