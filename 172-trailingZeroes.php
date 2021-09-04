<?php

class Solution {

    /**
     * 给定一个整数 n，返回 n! 结果尾数中零的数量。

    示例 1:
    输入: 3
    输出: 0
    解释: 3! = 6, 尾数中没有零。
     * @param Integer $n
     * @return Integer
     */
    function trailingZeroes($n)
    {
        $res = 0;
        $divisor = 5;
        while ($divisor <= $n) {
            $res += intval($n / $divisor);
            $divisor *= 5;
        }
        return $res;
    }
}