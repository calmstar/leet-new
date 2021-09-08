<?php

/**
 *  被围绕的区域
 *
 *  给你一个 m x n 的矩阵 board ，由若干字符 'X' 和 'O' ，
 * 找到所有被 'X' 围绕的区域，并将这些区域里所有的 'O' 用 'X' 填充。

 * Class Solution
 */
class Solution {

    /**
     * @param String[][] $board
     * @return NULL
     */
    function solve(&$board) {
        $m=sizeof($board);
        if($m==0){
            return;
        }
        $n=sizeof($board[0]);
        for($i=0;$i<$n;$i++){//处理第一行和最后一行
            $this->dfs($board,0,$i);
            $this->dfs($board,$m-1,$i);
        }
        for($i=0;$i<$m;$i++){//处理第一列和最后一列
            $this->dfs($board,$i,0);
            $this->dfs($board,$i,$n-1);
        }
        for($i=1;$i<$m-1;$i++){
            for($j=1;$j<$n-1;$j++){
                if($board[$i][$j]=='O'){//将剩余不连通的O标记为X
                    $board[$i][$j]='X';
                }
            }
        }

        for($i=0;$i<$m;$i++){//复原那些#
            for($j=0;$j<$n;$j++){
                if($board[$i][$j]=='#'){
                    $board[$i][$j]='O';
                }
            }
        }
    }

    function dfs(&$board,$i,$j){//将与边联通的O，全部标记为#
        $m=sizeof($board);
        $n=sizeof($board[0]);
        if($i<0||$i>=$m||$j<0||$j>=$n){
            return;
        }

        if($board[$i][$j]!='O'){
            return;
        }
        $board[$i][$j]='#';//标记

        // 向上下左右四个方向扩散
        $this->dfs($board,$i+1,$j);//递归dfs
        $this->dfs($board,$i,$j+1);//递归dfs
        $this->dfs($board,$i-1,$j);//递归dfs
        $this->dfs($board,$i,$j-1);//递归dfs
    }
}