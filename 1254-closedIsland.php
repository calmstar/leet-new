<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/IZQkb-M27dt-AZ1VICThOw
     * 封闭岛屿的数量
     *
     *  0 （土地）和 1 （水）
     *
     * 同第200道题，岛屿的数量。只需要提前把靠边的陆地淹没就行
     *
     * @param Integer[][] $grid
     * @return Integer
     */
    function closedIsland($grid) {
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

        // 开始计算岛屿数量
        $res = 0;
        for ($i = 0; $i < $rowLen; $i++) {
            for ($j = 0; $j < $colLen; $j++) {
                if ($grid[$i][$j] == 0) { //  0 （土地）和 1 （水）
                    $res++;
                    // 沉没周围的岛屿
                    $this->dfs($rowLen, $colLen, $grid, $i, $j);
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
        if ($grid[$i][$j] == 1) {
            // 已经是海水，不操作
            return;
        }

        // 淹没岛屿
        $grid[$i][$j] = 1;
        $this->dfs($rowLen, $colLen, $grid, $i-1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i+1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i, $j-1);
        $this->dfs($rowLen, $colLen, $grid, $i, $j+1);

    }


}