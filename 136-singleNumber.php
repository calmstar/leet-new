<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     *  原理：
     *      运用异或运算的性质：
    一个数和它本身做异或运算结果为 0，即 a ^ a = 0；
     *      一个数和 0 做异或运算的结果为它本身，即 a ^ 0 = a。
     */
    function singleNumber($nums) {
        $res = 0;
        foreach ($nums as $v) {
            $res ^= $v;
        }
        return $res;
    }
}