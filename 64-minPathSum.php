<?php

class Solution {

    /**
     * 最小路径和
     * 给定一个包含非负整数的 m x n 网格 grid ，请找出一条从左上角到右下角的路径，使得路径上的数字总和为最小。
    说明：每次只能向下或者向右移动一步。
     *
     * 状态：走的路径和
     * 选择：向下和向右
     * 定义：从 00位置走到ij位置的最小路径和是 dp[i][j] // i=m-1 j=n-1
     * 转移方程：dp[i][j] = min(dp[i-1][j], dp[i][j-1]) + $grid[i][j] // dp二维数组 定义也从0开始了；字符串 子串 子序列问题都是从1开始
     * baseCase
     *      dp[0][...] = 自行累加
     *      dp[...][0] = 自行累加
     *
     * 返回最小路径和
     *
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum($grid)
    {
        if (empty($grid)) return 0;
        $row = count($grid) - 1;
        $col = count($grid[0]) - 1;
        return $this->dp($grid, $row, $col);
    }

    /**
     * 备忘录法
     * 时间复杂度和空间复杂度都是O(MN)
     * @var array
     */
    private $memo = [];
    function dp ($grid, $row, $col)
    {
        // 跳过无用索引
        if (!isset($grid[$row][$col])) return PHP_INT_MAX;
        if ($row == 0 && $col == 0) return $grid[0][0];
        if (isset($this->memo[$row][$col])) return $this->memo[$row][$col];

        $this->memo[$row][$col] = min(
            $this->dp($grid, $row-1, $col), // 当前计算位置只跟上方 左边两个位置有关，memo可进行状态压缩
            $this->dp($grid, $row, $col-1)
        ) + $grid[$row][$col];
        return $this->memo[$row][$col];
    }

    // 方法2 ---- dpTable -------
    function dpTable ($grid)
    {
        if (empty($grid)) return 0;
        $row = count($grid) - 1;
        $col = count($grid[0]) - 1;
        $dp = [];
        // baseCase
        $dp[0][0] = $grid[0][0];
        for  ($i = 1; $i <= $row; $i++) { // 第一列向下移动
            $dp[$i][0] += $grid[$i][0] + $dp[$i-1][0];
        }
        for ($j = 1; $j <= $col; $j++) { // 第一行向右移动
            $dp[0][$j] += $grid[0][$j] + $dp[0][$j-1];
        }
        // dp可进行状态压缩，压缩成一纬 或 直接使用grid作为dp结果
        // dp[i][j] 定义：从00到ij位置的最小路径和
        for ($i = 1; $i <= $row; $i++) {
            for ($j = 1; $j <= $col; $j++) {
                $dp[$i][$j] = min(
                    $dp[$i-1][$j],
                    $dp[$i][$j-1]
                ) + $grid[$i][$j];
            }
        }
        return $dp[$row][$col];
    }

    // 减少空间复杂度：使用 一维数组 作为dpTable。todo: baseCase 不好做投影处理
    function dpTableV2 ($grid)
    {

    }

    // 减少空间复杂度：使用 grid 自身作为dpTable
    function dpTableV3 ($grid)
    {
        if (empty($grid)) return 0;
        $row = count($grid) - 1;
        $col = count($grid[0]) - 1;
        // baseCase
        for  ($i = 1; $i <= $row; $i++) { // 第一列向下移动
            $grid[$i][0] += $grid[$i-1][0];
        }
        for ($j = 1; $j <= $col; $j++) { // 第一行向右移动
            $grid[0][$j] += $grid[0][$j-1];
        }
        for ($i = 1; $i <= $row; $i++) {
            for ($j = 1; $j <= $col; $j++) {
                $grid[$i][$j] = min(
                        $grid[$i-1][$j],
                        $grid[$i][$j-1]
                    ) + $grid[$i][$j];
            }
        }
        return $grid[$row][$col];
    }
}

$grid = [
    [1,3,1],
    [1,5,1],
    [4,2,1]
];
$res = (new Solution())->dpTableV3($grid);
var_export($res);