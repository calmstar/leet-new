<?php
class Solution {

    /**
     * 参考：https://github.com/labuladong/fucking-algorithm/blob/master/%E5%8A%A8%E6%80%81%E8%A7%84%E5%88%92%E7%B3%BB%E5%88%97/%E9%AB%98%E6%A5%BC%E6%89%94%E9%B8%A1%E8%9B%8B%E9%97%AE%E9%A2%98.md
     *
     * 没搞懂，状态机问题
     *
     * @param $k
     * @param $n
     * @return int
     */
    function superEggDrop($k, $n) {
        return $this->dp($k, $n);
    }
    private $memo = [];
    /**
     *  状态：n层楼，k个鸡蛋 （一般作为dp参数 【 function dp($n, $k) 】 ）
     *  选择：在第几层楼扔（不知道就穷举，选择最优的结果；即用for循环，然后选择最优结果。）（需要状态转移方程进行演算）
     *  状态转移方程：
     *      res = min(
     *              res,
     *              max(
     *                  dp(k, n-i), // 鸡蛋没碎，还剩n-i层楼要测试
     *                  dp(k-1, i-1) // 鸡蛋碎了，还剩i-1层楼要测试
     *              ) + 1 // i为第几层楼；+1是因为已经扔了1次，次数+1
     *           )
     *
     * @param $k $k个鸡蛋
     * @param $n $n层楼
     * @return int
     */
    function dp ($k, $n)
    {
        if ($k == 1) return $n; // 只有一个鸡蛋，必须线性去扔
        if ($n == 0) return 0; // 0层楼，不需要扔
        if (isset($this->memo[$k][$n])) return $this->memo[$k][$n];
        $res = 0;
        for ($i = 1; $i <= $n; $i++) {
            $res = min(
                $res,
                max(
                    $this->dp($k, $n-$i),
                    $this->dp($k-1, $i-1)
                ) + 1
            );
        }
        $this->memo[$k][$n] = $res;
        return $res;
    }
}

$k = 1;
$n = 2;
$res = (new Solution())->superEggDrop($k,$n);
var_dump($res);