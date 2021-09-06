<?php

/**
 * https://mp.weixin.qq.com/s/fcCJFk89w953gXDjnlZFIA
 *
 * 为运算表达式设计优先级
 *
 * 给定一个含有数字和运算符的字符串，为表达式添加括号，改变其运算优先级以求出不同的结果。
 * 你需要给出所有可能的组合的结果。有效的运算符号包含 +, - 以及 * 。

示例 1:
输入: "2-1-1"
输出: [0, 2]
解释:
((2-1)-1) = 0
(2-(1-1)) = 2
 */
class Solution {

    /**
     * 分治法解决
     * @param String $expression
     * @return integer[]
     */
    function diffWaysToCompute($expression)
    {
        $len = strlen($expression);
        $res = [];
        // for循环里递归，有点回溯算法的味道；算法能解决问题就好，不要在意具体算法思想的定义和界限
        for ($i = 0; $i < $len; $i++) { // i决定宽度，baseCase决定高度
            // 判断当前字符是否为运算符号
            if ($expression[$i] == '+' || $expression[$i] == '-' || $expression[$i] == '*') {
                // ----------- 分 -----------
                $left = $this->diffWaysToCompute(substr($expression, 0, $i)); // 符号左边的所有字符
                $right = $this->diffWaysToCompute(substr($expression, $i+1)); // 符号右边的所有字符

                // -------------- 治 --------------
                foreach ($left as $l) {
                    foreach ($right as $r) {
                        if ($expression[$i] == '+') {
                             $res[] = $l + $r;
                        } elseif ($expression[$i] == '-') {
                             $res[] = $l - $r;
                        } else {
                             $res[] = intval($l * $r);
                        }
                    }
                }
            }
        }
        if (empty($res)) {
            // 说明该字符表达式没有运算符号
            return [$expression];
        } else {
            return $res;
        }
    }
}
$s = "2-1-1";
$res = (new Solution())->diffWaysToCompute($s);
var_export($res);