<?php
class Solution {

    private $memo = []; // $this->memo[$row][$col] 该行列的最小值

    function minFallingPathSum($matrix)
    {
        $cou = count($matrix);
        $min = PHP_INT_MAX;
        for ($i = 0; $i < $cou; $i++) {
            // 取得每一列的最小值
            $min = min($this->dp($matrix, $cou-1, $i), $min);
        }
        return $min;
    }

    function dp ($matrix, $row, $col)
    {
        if (isset($this->memo[$row][$col])) return $this->memo[$row][$col];
        $cou = count($matrix);
        if ($row < 0 || $col < 0 || $col >= $cou) {
            // 不合法索引，给到最大值即可
            return PHP_INT_MAX;
        }
        if ($row == 0) {
            // 递归出口
            return $matrix[0][$col];
        }
        // 后序遍历，得到baseCase再返回
        $this->memo[$row][$col] = $matrix[$row][$col] + min(
            $this->dp($matrix, $row-1, $col),
            $this->dp($matrix, $row-1, $col-1),
            $this->dp($matrix, $row-1, $col+1)
            );
        return $this->memo[$row][$col];
    }

    // --------------------

    private $min = PHP_INT_MAX;
    /**
     * 回溯法 -- 自底向上了，动态规划是逆推，自顶向下 --- 暴力法遍历 -- 我的解法 -- 待改造成memo法
     * 下降路径最小和
     * 多叉树的遍历问题
     * 给你一个 n x n 的 方形 整数数组 matrix ，请你找出并返回通过 matrix 的下降路径 的 最小和 。
     * @param Integer[][] $matrix
     * @return Integer
     */
    function minFallingPathSumMy($matrix)
    {
        if (empty($matrix)) return 0;
        $minIndex = 0;
        $maxIndex = count($matrix)-1;
        $this->backtracking($matrix, [], 0, $minIndex, $maxIndex); //辅助式递归
        return $this->min;
    }
    /**
     * @param $matrix
     * @param $tmp
     * @param $level
     * @param $minIndex
     * @param $maxIndex
     */
    function backtracking ($matrix, $tmp, $level, $minIndex, $maxIndex)
    {
       if (count($matrix) === count($tmp)) {
           $this->min = min($this->min, array_sum($tmp));
           return;
       }
       for ($i = $minIndex; $i <= $maxIndex; $i++) {
           array_push($tmp, $matrix[$level][$i]);
           $indexArr = $this->getIndex($matrix, $level, $i);
           $this->backtracking($matrix, $tmp, $level+1, $indexArr['min'], $indexArr['max']);
           array_pop($tmp);
       }
    }
    function getIndex ($matrix, $level, $i)
    {
        $maxIndex = count($matrix)-1;
        if ($level > $maxIndex) return [-1, -1];
        if ($i-1 < 0) {
            $min = $i;
        } else {
            $min = $i-1;
        }
        if ($i+1 > $maxIndex) {
            $max = $i;
        } else {
            $max = $i+1;
        }
        return ['min' => $min, 'max' => $max];
    }
}

$matrix = [[2,1,3],[6,5,4],[7,8,9]];
$res = (new Solution())->minFallingPathSum($matrix);
var_dump($res);