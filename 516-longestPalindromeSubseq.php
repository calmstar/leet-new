<?php

class Solution {

    /**
     * https://mp.weixin.qq.com/s/zNai1pzXHeB2tQE6AdOXTA
     * 最长回文子序列 的长度（同类 5-最长回文字串）
     *
     * 输入：s = "bbbab"
    输出：4
    解释：一个可能的最长回文子序列为 "bbbb" 。
     *
     * 动态规划法
     *
     * 字符子串从索引位置 i - j 的最长回文子序列为： dp[$i][$j]
     * 状态转移方程:
     *              当 dp[$i] == dp[$j] 时，dp[$i][$j] = 2 + dp[$i+1][$j-1]
     *              当 dp[$i] != dp[$j] 时, dp[$i][$j] = max(dp[$i+1][$j], dp[$i][$j-1])  不相等时，只能选择一边的子串
     *
     *
     * @param String $s
     * @return Integer
     */
    function longestPalindromeSubseq($s)
    {
        if (empty($s)) return 0;
        $dp = [];
        $cou = strlen($s);
        // 都初始化成0
        for ($i = 0; $i < $cou; $i++) {
            for ($j = 0; $j < $cou; $j++) {
                $dp[$i][$j] = 0;
            }
        }
        // 当 i j相等时，为1
        for ($i = 0; $i < $cou; $i++) {
            $dp[$i][$i] = 1;
        }

        // 反向遍历，保证正确的状态转移 从后往前
        for ($i = $cou-1; $i >= 0; $i--) {
            for ($j = $i+1;$j < $cou; $j++) {
                if ($s[$i] == $s[$j]) {
                    // 相等
                    $dp[$i][$j] = 2 + $dp[$i+1][$j-1];
                } else {
                    // 不相等
                    $dp[$i][$j] = max($dp[$i+1][$j], $dp[$i][$j-1]);
                }
            }
        }
        return $dp[0][$cou-1];
    }


}