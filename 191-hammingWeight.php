<?php
class Solution {
    /**
     * @param Integer $n
     * @return Integer
     */
    function hammingWeight($n)
    {
        if (empty($n)) return 0;
        $res = 0;
        while ($n != 0) {
            $res++;
            $n = ($n & ($n-1));
        }
        return $res;
    }
}