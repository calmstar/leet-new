<?php

class Solution {

    /**
     * 动态规划法 --
     * 时间复杂度 O(n)
     * 空间复杂度 O(1) --- 滚动数组方法, v2
     *
     * 定义：字符 1-i的翻译方案有dp[i]种
     * 最优子结构：算出dp[i-1]和dp[i-2]可以推导出dp[i] -- 数学推导思想，通过找规律进而找出通项公式
     * 状态转移方程： dp[i] = dp[i-1] + dp[i-2]（两个合成在 10-25之间） 或 dp[i-1]
     *
     * @param Integer $num
     * @return Integer
     */
    function translateNum($num)
    {
        $len = strlen($num);
        if ($len == 0) return 0;
        $num = (string)$num;

        $dp = []; // dp定义的位置开始是从1，$num从0
        $dp[0] = 1;
        $dp[1] = 1;
        for ($i = 2; $i <= $len; $i++) {
            $sum = $num[$i-1] + $num[$i-2] * 10 ;//注意是$num 索引-1处理，代表当前元素和前一个元素组合的数字
            if (10 <= $sum && $sum <= 25) { // 10 <= x <= 25
                $dp[$i] = $dp[$i-1] + $dp[$i-2];
            } else {
                $dp[$i] = $dp[$i-1];
            }
        }
        return $dp[$len];
    }

    // dp[i] 只跟dp[i-1] dp[i-2] 有关系，所以拍扁使用常量空间即可解决
    function translateNumV2 ($num)
    {
        $len = strlen($num);
        if ($len == 0) return 0;
        $num = (string)$num;

        $tmp1 = 1;
        $tmp2 = 1;
        $res = 1;
        for ($i = 2; $i <= $len; $i++) {
            $sum = $num[$i-1] + $num[$i-2] * 10;
            if (10 <= $sum && $sum <= 25) {
                $res = $tmp1 + $tmp2;
                $tmp1 = $tmp2;
                $tmp2 = $res;
            } else {
                $tmp1 = $tmp2;
                $res = $tmp2;
            }
        }
        return $res;
    }

}

$a = 25;
$res = (new Solution())->translateNum($a);
var_dump($res);

