<?php

class Solution {

    /**
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    function coinChange($coins, $amount) {
        if ($amount == 0 ) {
            return 0;
        }
        if ($amount < 0) {
            return -1;
        }

        // 动态规划，由底向上
        // 1 状态：金币的数量无限，所以状态为金额的数量
        // 2 选择：选哪个面值的硬币，1 2 5
        // 3 明确dp数组的定义： dp[n], 当金额为n时，所需要的硬币数量最少为dp[n]
        // 4 确定baseCase： dp[0] == 0, 当金额为0时，硬币0枚
        // 5 状态转移方程： 假设有三种面值硬币（coin1:1， coin2:2， coin3:5）,则：
        //          dp[n] = min( dp[n-coin1]+1, dp[n-coin2]+1, dp[n-coin3]+1 ) ，可画出递归树来看。
        //          例如 输入：coins = [1, 2, 5], amount = 11
        //          输出：3
        //          解释：11 = 5 + 5 + 1
        //      想象 金额11，则他可以有三种情况：  金额10+1枚1元，金额9+1枚2元，金额6+1枚5元，，
        //      则三种情况取最小值就是整体的最优值。是符合 最优子结构 的
        $dp = [];
        $dp[0] = 0;
        for ($i = 1; $i <= $amount; $i++) {
            $min = $amount+1;
            foreach ($coins as $coin) {
                if ($i - $coin < 0) continue;
                $min = min($dp[$i-$coin] + 1, $min);
            }
            $dp[$i] = $min;
        }
        return $dp[$amount] == $amount+1 ? -1 : $dp[$amount];
    }

    /**
     * 递归：
     *      1 明确函数定义 ：  当金额为$amount时，所需的最少硬币为  function xx($coins, $amount) { return $nums; }
     *      2 确定baseCase:  if ($amount == 0) return 0; if ($amount < 0) return -1;
     *      3 写出状态转移方程：return min(xx($coins, $amount-$coin1),  xx($coins, $amount-$coin2) ) // 三种选择取出一种最小的
     */
    private $memo=[];//备忘录
    function coinChangeRecursive ($coins, $amount)
    {
        if ($amount == 0) return 0;
        if ($amount < 0) return -1;
        if (isset($this->memo[$amount])) return $this->memo[$amount];

        $min = $amount+1;
        $cou = count($coins);
        for ($i = 0; $i < $cou; $i++) {
            if ($amount-$coins[$i] < 0) {
                continue;
            }
            $tmp = $this->coinChangeRecursive($coins, $amount-$coins[$i]);
            if ($tmp >= 0 && $tmp < $min) {
                $min = $tmp + 1;
            }
        }
        $this->memo[$amount] = $min == $amount+1 ? -1 : $min;
        return $this->memo[$amount];
    }
}

/**
 * [186,419,83,408]
6249
 */
$res = (new Solution())->coinChangeRecursive([186,419,83,408], 6249);
var_dump($res);


class SolutionOthers {

    /**
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    private $memo=[];//备忘录
    function coinChange($coins, $amount) {
        if($amount<0){//递归终止
            return -1;
        }
        if($amount==0){//递归终止
            return 0;
        }
        if(isset($this->memo[$amount])){//查找备忘录
            return $this->memo[$amount];
        }

        $min=PHP_INT_MAX;
        for($i=0;$i<sizeof($coins);$i++){//遍历搜索树
            $res=$this->coinChange($coins,$amount-$coins[$i]);
            if($res>=0&&$res<$min){
                $min=$res+1;
            }
        }

        $this->memo[$amount]=$min==PHP_INT_MAX?-1:$min;//备忘录更新
        return $this->memo[$amount];
    }
}

