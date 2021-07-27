<?php
class Solution {


    /**
     * @param $prices
     * @return int|mixed
     */
    function maxProfit($prices) {
        $cou = count($prices);
        if ($cou < 2) return 0;

        // 固定卖出时机，向前遍历寻找买入时机（最小的数字）; 暴力法是固定买入时机，猜测未来的卖出时机，需要暴力遍历
        $currMin = $prices[0];
        $res = 0;
        for ($i = 1; $i < $cou; $i++) {
            // 永远保持刷新此前的最小值
            $currMin = min($currMin, $prices[$i]);
            // 用 当前的卖出时机的价格 减去 以前最小的值
            $res = max($res, $prices[$i] - $currMin);
        }
        return $res;
    }

    /**
     * 暴力解法
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfitViolence($prices) {
        $cou = count($prices);
        if ($cou < 2) return 0;

        $maxProfit = 0;
        for ($i = 0; $i < $cou; $i++) {
            for ($j = $i+1; $j < $cou; $j++) {
                if ($prices[$i] < $prices[$j]) {
                    $maxProfit = max($prices[$j] - $prices[$i], $maxProfit);
                }
            }
        }
        return $maxProfit;
    }
}
$a = [7,1,5,3,6,4];
$b = (new Solution())->maxProfit($a);
var_dump($b);