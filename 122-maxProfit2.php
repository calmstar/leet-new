<?php
class Solution {

    /**
     * 参考js老毕
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        $cou = count($prices);
        if ($cou < 2) return 0;
        $allProfit = 0;
        $valley = 0;
        $peak = 0;
        for ($i = 0; $i < $cou-1; $i++) {
            while ($i < $cou && $prices[$i] >= $prices[$i+1]) {
                // 向下趋势
                $i++;
            }
            // 趋势最低点，取得波谷
            $valley = $prices[$i];
            while ($i < $cou && $prices[$i] <= $prices[$i+1]) {
                $i++;
            }
            $peak = $prices[$i];
            $allProfit += $peak - $valley;
        }
        return $allProfit;
    }
}

/**
 * 输入: prices = [7,1,5,3,6,4]
输出: 7
 * 在第 2 天（股票价格 = 1）的时候买入，在第 3 天（股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
     随后，在第 4 天（股票价格 = 3）的时候买入，在第 5 天（股票价格 = 6）的时候卖出, 这笔交易所能获得利润 = 6-3 = 3 。
 */
$prices = [7,1,5,3,6,4];
$res = (new Solution())->maxProfit($prices);
var_dump($res);
