<?php

class Solution {

    /**
     * @param String[][] $board
     * @return Integer
     */
    function countBattleships($board) {
        $cou = count($board);
        if ($cou < 1) return 0;

        $res = 0;
        for ($i = 0; $i < $cou; $i++) {
            $colCou = count($board[$i]);
            for ($j = 0; $j < $colCou; $j++) {
                if ($board[$i][$j] === 'X') {
                    $res++;
                    // 沉没四周的战舰（岛屿）
                    $this->dfs($i, $j, $board);
                }
            }
        }
        return $res;
    }

    function dfs ($row, $col, &$board)
    {
        $cou = count($board);
        $colCou = count($board[0]);
        if ($row < 0 || $row >= $cou || $col < 0 || $col >= $colCou || $board[$row][$col] !== 'X') {
            return;
        }
        $board[$row][$col] = '.';

        $this->dfs($row-1, $col, $board);
        $this->dfs($row+1, $col, $board);
        $this->dfs($row, $col-1, $board);
        $this->dfs($row, $col+1, $board);
    }
}

$a = [["X",".",".","X"],[".",".",".","X"],[".",".",".","X"]];
$res = (new Solution())->countBattleships($a);
var_dump($res);