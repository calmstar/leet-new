<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/Cw39C9MY9Wr2JlcvBQZMcA
     * 动态规划
     *  最优子结构：10元金额，只需要求得 10-x 金币下的最少硬币数量，加上一个 x 面值的硬币即可。
     *  状态转移方程：dp[amount] = 1 + dp[amount-coin]
     *  重叠子问题
     *
     * 步骤：
     *  1 状态 ：金额的数量变化
     *  2 函数定义：金额 $amount 下，最少有 coinChange($coins, $amount) 中组装方式
     *  3 选择：硬币的面值
     *  4 baseCase： 金额为0时，需要0个硬币； 金额为负数时，无解
     *
     * 三要素（函数定义，baseCase，状态转移方程）
     * 特征（最优子结构，重叠子问题，状态，选择）
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

    // ----------
    // 迭代法
    function coinChangeV3($coins, $amount) {
        $dp = [];
        $dp[0] = 0;
        for ($i = 1; $i <= $amount; $i++) {
            // 其他金币进行初始化
            $dp[$i] = $amount + 1;
            foreach ($coins as $coin) {
                $res = $i - $coin;
                if ($res < 0) continue;
                $dp[$i] = min(1 + $dp[$res], $dp[$i]);
            }
        }
        return $dp[$amount] == $amount + 1 ? -1 : $dp[$amount];
    }

}

$coins = [2];
$amount = 3;
$res = (new Solution())->coinChangeV3($coins, $amount);
var_dump($res);