<?php

class Solution {

    /**
     * 类似于 1254题目
     * https://mp.weixin.qq.com/s/IZQkb-M27dt-AZ1VICThOw
     * @param Integer[][] $grid
     * @return Integer
     */
    function numEnclaves($grid) {
        if (empty($grid)) return 0;
        $rowLen = count($grid);
        $colLen = count($grid[0]);

        // 淹没 最左边和最右边 的陆地
        for ($i = 0; $i < $rowLen; $i++) {
            $this->dfs($rowLen, $colLen, $grid, $i, 0);
            $this->dfs($rowLen, $colLen, $grid, $i, $colLen-1);
        }
        // 淹没 最上边和最下边 的陆地
        for ($j = 0; $j < $colLen; $j++) {
            $this->dfs($rowLen, $colLen, $grid, 0, $j);
            $this->dfs($rowLen, $colLen, $grid, $rowLen-1, $j);
        }
        // 开始计算岛屿面积
        $res = 0;
        for ($i = 0; $i < $rowLen; $i++) {
            for ($j = 0; $j < $colLen; $j++) {
                if ($grid[$i][$j] == 1) {
                    $res++;
                    // 此题就不需要 沉没周围的岛屿
//                    $this->dfs($rowLen, $colLen, $grid, $i, $j);
                }
            }
        }
        return $res;
    }

    function dfs ($rowLen, $colLen, &$grid, $i, $j)
    {
        if ($i < 0 || $j < 0 || $i >= $rowLen || $j >= $colLen) {
            // 超出数组索引
            return;
        }
        if ($grid[$i][$j] == 0) {
            // 已经是海水，不操作
            return;
        }

        // 淹没岛屿
        $grid[$i][$j] = 0;
        $this->dfs($rowLen, $colLen, $grid, $i-1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i+1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i, $j-1);
        $this->dfs($rowLen, $colLen, $grid, $i, $j+1);

    }

}