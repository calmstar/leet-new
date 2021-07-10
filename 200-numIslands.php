<?php

class Solution {

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        $num = 0;
        $cou = count($grid);
        for ($i = 0; $i < $cou; $i++) {
            for ($j = 0; $j < count($grid[$i]); $j++) {
                if ($grid[$i][$j]) {
                    // 为1，是岛屿，得到四周岛屿的坐标。向四周扩散开始沉默
                    $grid = $this->xx([[$i, $j]], $grid);
                    $num++;
                }
            }
        }
        return $num;
    }

    function xx ($zb, $grid) {
        $rowCou = count($grid);
        for ($i = 0; $i < count($zb); $i++)  { // zb坐标
            $v = $zb[$i];
            $colCou = count($v);
            $i = $v[0];
            $j = $v[1];

            // 将坐标置为0，沉没
            $grid[$i][$j] = 0;

            // 得到周围的坐标，并判断是否合法坐标
            // 上面的坐标是否合法，是否为1
            if (0 <= $i-1 && $grid[$i-1][$j]) {
                array_push($zb, [$i-1, $j]);
            }
            // 下
            if ($i+1 < $rowCou && $grid[$i+1][$j]) {
                array_push($zb, [$i+1, $j]); // 赋值进去的zb没法到foreach中起到作用,所以换成for循环
            }
            // 右
            if ($j+1 < $colCou && $grid[$i][$j+1]) {
                array_push($zb, [$i, $j+1]);
            }
            // 左
            if (0 <= $j-1  && $grid[$i][$j-1]) {
                array_push($zb, [$i, $j-1]);
            }
        }
        return $grid;
    }
}

/**
方法2 -- 递归 -- 深度优先搜索
class Solution {
function numIslands($grid) {
    $num = 0;
    $cou = count($grid);
    for ($i = 0; $i < $cou; $i++) {
        for ($j = 0; $j < count($grid[$i]); $j++) {
            if ($grid[$i][$j]) {
                // 为1，是岛屿，得到四周岛屿的坐标。向四周扩散开始沉默
                $this->dfs($grid, $i, $j);
                $num++;
            }
        }
    }
    return $num;
}

function dfs (&$grid, $x, $y) {
    if (isset($grid[$x][$y]) && $grid[$x][$y] == 1) {
        $grid[$x][$y] = 0;
        $this->flipIslands($grid, $x-1, $y);
        $this->flipIslands($grid, $x+1, $y);
        $this->flipIslands($grid, $x, $y-1);
        $this->flipIslands($grid, $x, $y+1);

    }
}
}


 */






