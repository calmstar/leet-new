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
}

$a = [
    [0,0,1,0,0,0,0,1,0,1,0,0,0],
    [0,0,0,0,0,0,0,1,1,1,0,0,0]
];
$res = (new Solution())->maxAreaOfIsland($a);
var_dump($res);


