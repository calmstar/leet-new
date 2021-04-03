<?php

// 双指针法 或 反转法
function isPalindrome($x) {
    if ($x < 0) return false;
    $len = strlen($x);
    $midIndex = intval($len/2);
    $x = (string)$x;
    for ($i = 0; $i < $midIndex; $i++) {
        if ($x[$i] != $x[$len-$i-1]) {
            return false;
        }
    }
    return true;
}