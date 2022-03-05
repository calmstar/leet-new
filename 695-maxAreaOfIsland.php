<?php

class Solution {

    /**
    * @param Integer[][] $grid
    * @return Integer
    */
    function maxAreaOfIsland($grid)
    {
        if (empty($grid)) return 0;
        $rowCou = count($grid);
        $num = 0;
        $allMax = 0;
        for ($i = 0; $i < $rowCou; $i++) {
            $colCou = count($grid[$i]);
            for ($j = 0; $j < $colCou; $j++) {
                if ($grid[$i][$j] == 1) {
                    // 开始沉没
                    $num++;
                    $allMax = max($this->dfs($grid, $i, $j), $allMax);
                }
            }
        }
//        return $num;
        return $allMax;
    }

    // 递归，深度优先遍历
    function dfs (&$grid, $row, $col)
    {
        if (!isset($grid[$row][$col]) || $grid[$row][$col] == 0) {
            return 0;
        }

        $grid[$row][$col] = 0; //沉没
        $res1 = $this->dfs($grid, $row+1, $col);
        $res2 = $this->dfs($grid, $row-1, $col);
        $res3 = $this->dfs($grid, $row, $col+1);
        $res4 = $this->dfs($grid, $row, $col-1);
        return $res4 + $res3 + $res2 + $res1 + 1;
    }

    // ---------- 以下为labuladong解法 -----------
    function maxAreaOfIslandV2($grid) {
        if (empty($grid)) return 0;
        $rowLen = count($grid);
        $colLen = count($grid[0]);
        $maxArea = 0;
        for ($i = 0; $i < $rowLen; $i++) {
            for ($j = 0; $j < $colLen; $j++) {
                if ($grid[$i][$j] == '1') {
                    // 让周围的岛屿沉没并计算出岛屿的面积返回
                    $maxArea = max($this->dfsV2($rowLen, $colLen, $grid, $i, $j), $maxArea);
                }
            }
        }
        return $maxArea;
    }
    // 向周围扩散，让岛屿沉没
    function dfsV2 ($rowLen, $colLen, &$grid, $i, $j)
    {
        if ($i < 0 || $j < 0 || $i >= $rowLen || $j >= $colLen) {
            // 超出数组索引
            return 0;
        }
        if ($grid[$i][$j] == 0) {
            // 已经是海水，不操作
            return 0;
        }
        // 岛屿改成海水（淹没岛屿，方便判断）
        $grid[$i][$j] = 0;
        // 向四周的岛屿扩散，判断是否沉没
        $area1 = $this->dfsV2($rowLen, $colLen, $grid, $i-1, $j);
        $area2 = $this->dfsV2($rowLen, $colLen, $grid, $i+1, $j);
        $area3 = $this->dfsV2($rowLen, $colLen, $grid, $i, $j-1);
        $area4 = $this->dfsV2($rowLen, $colLen, $grid, $i, $j+1);
        return $area1 + $area2 + $area3 + $area4 + 1;
    }


}

$a = [
    [0,0,1,0,0,0,0,1,0,1,0,0,0],
    [0,0,0,0,0,0,0,1,1,1,0,0,0]
];
$res = (new Solution())->maxAreaOfIsland($a);
var_dump($res);


