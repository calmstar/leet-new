<?php
class Solution {

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
}
$a = [[1,3,1], [1,5,1], [4,2,1]];
$res = (new Solution())->maxValue($a);
var_dump($res);