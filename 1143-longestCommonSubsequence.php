<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/ZhPEchewfc03xWv9VP3msg
     * 计算 最长公共子序列 的长度
     *
     * 动态规划（自顶向下，由未知的方程直到推到递归出口，然后回归得出结果）
     *      函数定义：dp(s1, i, s2, j) 表示字符串 s1[i...] 和 s2[j...] 的最长公共子序列
     *      baseCase ： 当 i==len(s1) && j==len(s2) 时，函数结果为0
     *      状态转移方程：
     *          if (s1[i] == s2[j]) {
                    res = 1 + dp(s1, i+1, s2, j+1) // 相等
     *          } else {
     *              res = max(
     *                  dp(s1, i, s2, j+1),
     *                  dp(s1, i+1, s2, j),
     *                  dp(s1, i+1, s2, j+1),
     *              )// 不相等, 取最长的
     *          }
     *
     * @param String $text1
     * @param String $text2
     * @return Integer
     */
    function longestCommonSubsequence($text1, $text2)
    {
        if (empty($text1) || empty($text2)) return 0;
        $max1 = strlen($text1)-1;
        $max2 = strlen($text2)-1;
        return $this->dp($text1, $text2, 0, 0, $max1, $max2);
    }

    private $memo = [];
    // 定义：从索引位置t1 t2开始到末尾的，两个text的最长子序列
    function dp ($text1, $text2, $t1, $t2, $max1, $max2)
    {
        if ( isset($this->memo[$t1][$t2]) ) return $this->memo[$t1][$t2];

        // baseCase
        if ($t1 > $max1 || $t2 > $max2) return 0;
        if ($text1[$t1] == $text2[$t2]) {
            // 相等，都算入最长公共子序列中
            $this->memo[$t1][$t2] = $this->dp($text1, $text2, $t1+1, $t2+1, $max1, $max2) + 1;
        } else {
            // 不相等
            $this->memo[$t1][$t2] =  max(
                $this->dp($text1, $text2, $t1+1, $t2, $max1, $max2), // $text1[$t1]的字符 存在于最长公共子序列
                $this->dp($text1, $text2, $t1, $t2+1, $max1, $max2), //  $text2[$t2]的字符 存在于最长公共子序列
                $this->dp($text1, $text2, $t1+1, $t2+1, $max1, $max2) //  $text1[$t1] 和 $text2[$t2]的字符 都不存在于最长公共子序列
            );
        }
        return $this->memo[$t1][$t2];
    }

    /**
     * 如何看出有冗余计算？
     * int dp(int i, int j) {
    dp(i + 1, j + 1); // #1
    dp(i, j + 1);     // #2
    dp(i + 1, j);     // #3
    }
     * 你看，假设我想从dp(i, j)转移到dp(i+1, j+1)，有不止一种方式，可以直接走#1，也可以走#2 -> #3，也可以走#3 -> #2。
     */

    // 迭代求法 -- 自底向上 dp table
    /**
     *
     * 动态规划（自底向上，由已知推向结果）
     *      定义：
     *          s1[0...i-1] s2[0...j-1]的lcs长度为 dp[i][j]
     *              (dp table 相比索引大1，dp[0][0] 的时候相当于空字符)
     *              （dp[0][0] 相当于 s1[-1] s2[-1], 0是dp table 的哨兵节点）
     *      baseCase:
                当有一个字符串为空字符时，结果为0，则：
     *          dp[0][i] = 0
     *          dp[0][j] = 0
     *      状态转移方程：
     *          if (s1[i] == s2[j]) {
                    res = dp[i][j] = 1 + dp[i-1][j-1] // 相等，直接 当前字符1 + 上一个状态的最长子序列数量
     *          } else {
     *              res = max(dp[i-1][j], dp[i][j-1]) // 不相等，直接取上一个状态中最大的
     *          }
     *
     * @param $text1
     * @param $text2
     */
    function dpTable ($text1, $text2)
    {
        $l1 = strlen($text1);
        $l2 = strlen($text2);
        $dp = [];
        // 初始化base case  dp[0][...] = 0  dp[...][0] = 0，把0索引的位置当成空字符
        for ($i = 0; $i <= $l1; $i++) {
            $dp[$i][0] = 0;
        }
        for ($j = 0; $j <= $l2; $j++) {
            $dp[0][$j] = 0;
        }

        for ($i = 1; $i <= $l1; $i++) {
            for ($j = 1; $j <= $l2; $j++) {
                if ($text1[$i-1] == $text2[$j-1]) {
                    // 相等，两个字符都在lcs中，直接用其上一个状态 $dp[$i-1][$j-1]+1
                    $dp[$i][$j] = 1 + $dp[$i-1][$j-1];
                } else {
                    // 不相等,至少有一个不再lcs中
                    $dp[$i][$j] = max($dp[$i-1][$j], $dp[$i][$j-1]); // 注：可以看出 $dp[$i][$j] 只和左边和上边的位置有关，可以拍扁成一维数组
                }
            }
        }
        return $dp[$l1][$l2];
    }


}