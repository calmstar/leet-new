<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/IZQkb-M27dt-AZ1VICThOw
     * @param Integer[][] $grid1
     * @param Integer[][] $grid2
     * @return Integer
     */
    function countSubIslands($grid1, $grid2) {
        if (empty($grid2)) return 0;
        $rowLen = count($grid2);
        $colLen = count($grid2[0]);

        // 把非子岛的岛屿淹没
        for ($i = 0; $i < $rowLen; $i++) {
            for ($j = 0; $j < $colLen; $j++) {
                if ($grid1[$i][$j] == 0 && $grid2[$i][$j] == 1) {
                    // 0水 1陆地
                    // 这个岛屿肯定不是子岛，淹掉
                    $this->dfs($rowLen, $colLen, $grid2, $i, $j);
                }
            }
        }

        $res = 0;
        for ($i = 0; $i < $rowLen; $i++) {
            for ($j = 0; $j < $colLen; $j++) {
                if ($grid2[$i][$j] == 1) {
                    $res++;
                    // 让周围的岛屿沉没
                    $this->dfs($rowLen, $colLen, $grid2, $i, $j);
                }
            }
        }
        return $res;
    }



    // 向周围扩散，让岛屿沉没
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
        // 岛屿改成海水（淹没岛屿，方便判断）
        $grid[$i][$j] = 0;
        // 向四周的岛屿扩散，判断是否沉没
        $this->dfs($rowLen, $colLen, $grid, $i-1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i+1, $j);
        $this->dfs($rowLen, $colLen, $grid, $i, $j-1);
        $this->dfs($rowLen, $colLen, $grid, $i, $j+1);
    }

}