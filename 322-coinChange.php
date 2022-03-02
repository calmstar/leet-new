<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/Cw39C9MY9Wr2JlcvBQZMcA
     * 动态规划
     *  最优子结构
     *  状态转移方程
     *  重叠子问题
     *
     * 步骤：
     *  1 状态
     *  2 函数定义
     *  3 选择
     *  4 baseCase
     */

    /**
     * 无备忘录
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    function coinChange($coins, $amount) {
        if ($amount < 0) return -1;
        if ($amount == 0) return 0;

        $currentMin = PHP_INT_MAX;
        foreach ($coins as $coin) {
            $res = $this->coinChange($coins, $amount - $coin);
            if ($res == -1) continue; // 选择当前硬币，无法凑够零钱
            $currentMin = min($currentMin, $res + 1);
        }
        return $currentMin == PHP_INT_MAX ? -1 : $currentMin;
    }

    // -----------
    private $memo=[];//备忘录
    function coinChangeV2($coins, $amount) {
        if ($amount == 0) return 0;
        if ($amount < 0) return -1;
        if (isset($this->memo[$amount])) return $this->memo[$amount];

        $min = $amount+1;
        $cou = count($coins);
        for ($i = 0; $i < $cou; $i++) {
            $tmp = $this->coinChangeV2($coins, $amount-$coins[$i]);
            if ($tmp >= 0 && $tmp < $min) {
                $min = $tmp + 1;
            }
        }
        $this->memo[$amount] = $min == $amount+1 ? -1 : $min;
        return $this->memo[$amount];
    }

}

$coins = [1, 2, 5];
$amount = 11;
$res = (new Solution())->coinChange($coins, $amount);
var_dump($res);