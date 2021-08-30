<?php

// 0 1 背包问题: https://mp.weixin.qq.com/s/RXfnhSpVBmVneQjDSUSAVQ
/**
 * 给你一个可装载重量为W的背包和N个物品，每个物品有重量和价值两个属性。
 * 其中第i个物品的重量为wt[i]，价值为val[i]，现在让你用这个背包装物品，最多能装的价值是多少？

举个简单的例子，输入如下：
N = 3, W = 4
wt = [2, 1, 3]          //注意：索引是从0开始的，下面定义的dp是从1开始的
val = [4, 2, 3]
 * 算法返回 6，选择前两件物品装进背包，总重量 3 小于W，可以获得最大价值 6。
 */
/**
 * 状态：物品数量  重量
 * 选择：放进背包   不放进背包
 *      for (状态1...) {
 *          for (状态2...) {
 *              for (状态n...) {
                    dp[状态1][状态2][状态n...] = 择优(选择1, 选择2, ...)
 *              }

 *          }
 *      }
 *
 * 定义：
 *      对于前i个商品放入背包重量为j时，礼物最大价值为：dp[i][j]
 *
 * 状态转移方程：
 *      不放入背包：dp[i][j] = dp[i-1][j]   //等价于上一次选择物品的总价值
 *      放入背包：  dp[i][j] = dp[i-1][j-wt[i-1]] + val[i-1]          // j-wt[i-1]为剩余价值； val[i-1]为第i个商品的价值
 *
 * baseCase:
 *      dp[0][j...] = 0 // 没有物品，装的价值为0
 *      dp[i...][0] = 0 // 没有容量，装的价值只能为0
 *
 * @param $n int 物品数量
 * @param $w int 重量
 * @param $wt array
 * @param $val array
 */
function package ($n, $w, $wt, $val)
{
    if (empty($wt) || empty($val)) {
        return 0;
    }
    $dp = [];
    for ($i = 0; $i <= $n; $i++) {
        $dp[$i][0] = 0;
    }
    for ($j = 0; $j <= $w; $j++) {
        $dp[0][$j] = 0;
    }
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $w; $j++) {
            if ($j-$wt[$i-1] < 0) {
                // 当前容量不够装入
                $dp[$i][$j] = $dp[$i-1][$j];
            } else {
                // 可以装入
                $dp[$i][$j] = max(
                    $dp[$i-1][$j], //不装入情况，取上一个物品数量的值（$i-1），容量不变（$j）
                    $dp[$i-1][$j-$wt[$i-1]] + $val[$i-1] // 装入情况：  j-wt[i-1]为剩余价值； val[i-1]为第i个商品的价值
                );
            }
        }
    }
    return $dp[$n][$w];
}
