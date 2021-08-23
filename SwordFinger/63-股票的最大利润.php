<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices)
    {
        $cou = count($prices);
        if ($cou < 2) return 0;
        $currMin = $prices[0];
        $res = 0;
        for ($i = 1; $i < $cou; $i++) {
            $currMin = min($currMin, $prices[$i]);
            $res = max($res, $prices[$i]-$currMin);
        }
        return $res;
    }

    // 暴力解法 O(n2) 同leetcode-121

}