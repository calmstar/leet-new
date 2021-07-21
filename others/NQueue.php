<?php

// n代表棋盘的格子数 - 正方形
class Solution {
    public function solveNQueens ($n)
    {
        // 生成
        $board = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $board[$i][$j] = '.';
            }
        }
        $res = [];
        $row = 0;
        $this->backtrack($row , $res, $board);
        return $res;
    }

    private function backtrack ($row , &$res, &$board)
    {
        $cou = count($board)-1;
        if ($cou+1 == $row) { // 注意此处相等值
            $tmp = [];
            foreach ($board as $item) {
                $tmp[] = implode('', $item);
            }
            $res[] = $tmp;
            return;
        }
        for ($col = 0; $col <= $cou; $col++) {
            if (!$this->isValid($board, $row, $col)) continue;
            $board[$row][$col] = 'Q';
            $this->backtrack($row+1, $res, $board);
            $board[$row][$col] = '.';
        }
    }

    private function isValid ($board, $row, $col)
    {
        $cou = count($board);
        // 不能同一列
        for ($i = $row - 1; $i >= 0; $i--) {
            if ($board[$i][$col] == 'Q') {
                return false;
            }
        }
        // 不能左上
        for ($i = $row - 1, $j = $col - 1; $i >= 0 && $j >= 0; $i--, $j--) {
            if ($board[$i][$j] == 'Q') {
                return false;
            }
        }
        // 不能右上
        for ($i = $row - 1, $j = $col + 1; $i >= 0 && $j <= $cou - 1; $i--, $j++) {
            if ($board[$i][$j] == 'Q') {
                return false;
            }
        }
        return true;
    }
}
$res = (new Solution())->solveNQueens(4);
var_dump($res);