<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/ZhPEchewfc03xWv9VP3msg
     * 最长公共子序列
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
                $this->dp($text1, $text2, $t1+1, $t2+1, $max1, $max2) //  $text1[$t1] 和 $text2[$t2]的字符 存在于最长公共子序列
            );
        }
        return $this->memo[$t1][$t2];
    }

    /**
     * int dp(int i, int j) {
    dp(i + 1, j + 1); // #1
    dp(i, j + 1);     // #2
    dp(i + 1, j);     // #3
    }
     * 你看，假设我想从dp(i, j)转移到dp(i+1, j+1)，有不止一种方式，可以直接走#1，也可以走#2 -> #3，也可以走#3 -> #2。
     */

}