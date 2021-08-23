<?php

class Solution {

    /**
     * 答案需要取模 1e9+7（1000000007），如计算初始结果为：1000000008，请返回 1。
     * @param Integer $n
     * @return Integer
     */
    function numWays($n) {
        if ($n < 3) return $n;
        $first = 1;
        $second = 2;
        for ($i = 3; $i <= $n; $i++) {
            $all = ($first + $second) % (pow(10, 9)+7);
            $first = $second;
            $second = $all;
        }
        return $all;
    }
}