<?php
class Solution {

    /**
     * 回溯算法框架
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word) {
        //$board = [["a","b","c","e"],["s","f","c","s"],["a","d","e","e"]];
        //$word = "abfb";
        $wordArray = str_split($word);
        $wordLength = count($wordArray);

        $boardLength = count($board[0]);
        $boardHigh = count($board);

        for ($i=0; $i<$boardHigh; $i++) {
            for ($j=0; $j<$boardLength; $j++) {
                $result = $this->dfs(0, $i, $j, $board, $wordArray, $wordLength);
                if ($result) {
                    return true;
                }
            }
        }

        return false;
    }

    function dfs($step, $i, $j, $board, $wordArray, $wordLength)
    {
        if ($step == $wordLength) {
            return true;
        }

        if (!isset($board[$i][$j])) {
            return false;
        }

        if ($board[$i][$j] != $wordArray[$step]) {
            return false;
        }

        $board[$i][$j] = '/';
        $up = $this->dfs($step+1, $i-1, $j, $board, $wordArray, $wordLength);
        if ($up) {
            return true;
        }

        $down = $this->dfs($step+1, $i+1, $j, $board, $wordArray, $wordLength);
        if ($down) {
            return true;
        }

        $left = $this->dfs($step+1, $i, $j-1, $board, $wordArray, $wordLength);
        if ($left) {
            return true;
        }

        $right = $this->dfs($step+1, $i, $j+1, $board, $wordArray, $wordLength);
        if ($right) {
            return true;
        }

        return false;
    }

    // ---------- 知识回顾 -------
    // 遍历多叉树框架 -- 回溯算法
    function xx ($root)
    {
//        echo $root->val; // 遍历每个节点
        foreach ($root as $children) {
//            echo $children->val; // 只遍历子节点，一开始的root节点没打印到
            $this->xx($children);
        }
    }

    // 全排列解法： [1,2,3] 的所有全排列（数学中的排列，顺序有关区分：A3-3 = 3*2*1 = 6 ）
    private $res = [];
    private $arr = [1, 2, 3];
    function permute ($arr)
    {
        $track = [];
        $this->traverse($arr, $track);
        return $this->res;
    }
    function traverse ($arr, $track)
    {
        if (count($arr) == count($track)) $this->res[] = $track;

        foreach ($arr as $v) {
            if (in_array($v, $track)) continue;
            // 做选择
            array_push($track, $v);
            $this->traverse($arr, $track);
            // 撤销选择
            array_pop($track);
        }
    }
}

// 回溯 -- 全排列
$res = (new Solution())->permute([1,2,3]);
var_export($res);