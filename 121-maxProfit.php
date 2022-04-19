<?php
class Solution {


    /**
     * 参考js老毕
     *
     * 给定一个数组 prices ，它的第 i 个元素 prices[i] 表示一支给定股票第 i 天的价格。
    你只能选择 某一天 买入这只股票，并选择在 未来的某一个不同的日子 卖出该股票。设计一个算法来计算你所能获取的最大利润。
    返回你可以从这笔交易中获取的最大利润。如果你不能获取任何利润，返回 0 。
     * @param $prices
     * @return int|mixed
     */
    function maxProfit($prices) {
        $cou = count($prices);
        if ($cou < 2) return 0;

        $currMin = $prices[0];
        $res = 0;
        // 一次遍历，遍历时保存此前遍历过的最小值，用当前索引值减去历史最小值
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

    function xx ($prices)
    {
        $cou = count($prices);
        if ($cou == 0) return 0;
        $min = $prices[0];
        $res = 0;
        for ($i = 1; $i < $cou; $i++) {
            $min = min($prices[$i], $min);
            $res = max($res, $prices[$i] - $min);
        }
        return $res;
    }
}
$a = [7,1,5,3,6,4];
$b = (new Solution())->maxProfit($a);
var_dump($b);