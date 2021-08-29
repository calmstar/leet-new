<?php
class Solution {

    /**
     * @param Integer $m
     * @param Integer $n
     * @param Integer $k
     * @return Integer
     */
    function movingCount($m, $n, $k) {
        if ($k == 0) {
            //0 + 0 = 0 符合题意直接返回
            return 1;
        }
        $visited = [];
        return $this->dfs(0, 0, $k, $m, $n, $visited);
    }

    /** 用&引用代替形参，实现指针传递，减少多余的内存申请释放过程所消耗的时间 */
    function dfs($x, $y, &$k, &$m, &$n, &$visited) {
        if ($this->getRowColumnSum($x, $y) > $k) {
            return 0;
        }

        //当前位置符合条件累加一步
        $sum = 1;
        //当前的位置标记为true，即为走过
        $visited[$y][$x] = true;

        //先进行下一步位置范围准确性检测再进行搜索，减少不必要的函数调用。
        if (($tmpX = $x + 1) < $m && ! $visited[$y][$tmpX]) {
            $sum += $this->dfs($tmpX, $y, $k, $m, $n, $visited);
        }

        if (($tmpY = $y + 1) < $n && ! $visited[$tmpY][$x]) {
            $sum += $this->dfs($x, $tmpY, $k, $m, $n, $visited);
        }
        //返回自身加上从右边以及下边开始搜索到的总和
        return $sum;
    }

    function getRowColumnSum($x, $y) {
        //根据题目输入条件：1 <= n,m <= 100，可得x, y坐标最多为两位数，可直接执行运算，减少while条件判断(只针对已知题目限制才这样写，平时不可取)
        return intval($x / 10) + $x % 10 + intval($y / 10) + $y % 10;
    }
}
