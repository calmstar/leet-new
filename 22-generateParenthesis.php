<?php

// 有效的括号
function generateParenthesis ($n)
{
    $arr = [];
    backTracking ($n, 0, 0, '', $arr);
    return $arr;

}

function backTracking ($n, $left, $right, $str, &$arr)
{
    if ($right > $left) return ;
    if ($n == $left && $n == $right) {
        $arr[] = $str;
        return ;
    }

    if ($left < $n) {
        backTracking($n, $left + 1, $right, $str . '(', $arr);
    }
    if ($left > $right) {
        backTracking($n, $left, $right + 1, $str . ')', $arr);
    }
}