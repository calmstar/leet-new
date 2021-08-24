<?php
class Solution {

    // ----------- 方法1 ：动态规划 - 缓存法 ---------
    /**
     * 最优子结构：计算出最右下角的 上面和左边 位置的最大值，加上右下角本身的礼物价值，就可以得到总的礼物最大价值
     * 状态转移方程：dp[i][j] = max(dp[i-1][j], dp[i][j-1])
     *
     * 类似于走格子有多少种走法 dp[i][j] = dp[i-1][j] + dp[i][j-1]
     *
     * @param Integer[][] $grid
     * @return Integer
     */
    function maxValue($grid)
    {
        if (empty($grid)) return 0;
        $i = count($grid);
        $j = count($grid[0]);
        return $this->dp($grid, $i, $j);
    }
    // 优化：可将二维缓存数组拍扁
    private $memo = [];
    function dp ($grid, $i, $j)
    {
        if ($i < 0 || $j < 0) return 0;
        if ( $i == 0 && $j == 0 ) return $grid[$i][$j];
        if (isset($this->memo[$i][$j])) return $this->memo[$i][$j];

        $this->memo[$i][$j] = max($this->dp($grid, $i-1, $j), $this->dp($grid, $i, $j-1)) + $grid[$i][$j];
        return $this->memo[$i][$j];
    }

    /** --------- 方法2 动态规划 -- dp table 法 ---------
     https://leetcode-cn.com/problems/li-wu-de-zui-da-jie-zhi-lcof/solution/mian-shi-ti-47-li-wu-de-zui-da-jie-zhi-dong-tai-gu/
        从第1个位置开始递推，推到 dp[i][j]
     * 时间复杂度 O(mn)
     * 空间复杂度 O(1)  -- 直接在grid原地修改推算
     */
    function maxValueV2 ($grid)
    {
        if (empty($grid)) return 0;
        $n = count($grid);
        $m = count($grid[0]);
        // 初始化第一行的值：只从左边推算得来
        for ($i = 1; $i < $m; $i++) {
            $grid[0][$i] += $grid[0][$i-1];
        }
        // 初始化第一列的值：只从上面推算得来
        for ($j = 1; $j < $n; $j++) {
            $grid[$j][0] += $grid[$j-1][0];
        }
        // 推算其他单元的值
        for ($i = 1; $i < $n; $i++) {
            for ($j = 1; $j < $m; $j++) {
                $grid[$i][$j] = max($grid[$i-1][$j], $grid[$i][$j-1]) + $grid[$i][$j];
            }
        }
        return $grid[$n][$m];
    }

}
$a = [[1,3,1], [1,5,1], [4,2,1]];
$res = (new Solution())->maxValue($a);
var_dump($res);