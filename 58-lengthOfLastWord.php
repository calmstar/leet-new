<?php

/**
 * @param $s
 * @return int
 */
function lengthOfLastWord($s)
{
    if (empty($s)) return 0;
    $arr = explode(' ', $s);
    $cou = count($arr);
    for ($i = $cou-1; $i >= 0; $i--) {
        if (!empty($arr[$i])) return strlen($arr[$i]);
    }
    return 0;
}