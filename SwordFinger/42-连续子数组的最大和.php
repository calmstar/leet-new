<?php
class Solution {

    function maxSubArray($nums)
    {
        $cou = count($nums);
        if (empty($cou)) return 0;

        // 动态规划思想，-- 数学归纳法 -- 递推法 -- 定义与通项公式
        // 定义：以$i位置为'结尾'的 最大的子数组和为：dp[$i].
        //      dp[i-1]如何推导出dp[$i]:
        //                dp[$i]有两种选择：要么跟 dp[i-1] 相加得到更大的和，要么自成一派。
        //                  状态转移方程就是 dp[$i] = max(dp[$i], dp[$i]+dp[$i-1])
        for ($i = 1; $i < $cou; $i++) {
            if ($nums[$i-1] > 0) {
                $nums[$i] = $nums[$i] + $nums[$i-1];
            }
        }
        return max($nums);
    }

    // 上面原地改造数组 空间复杂度O(1)  --- 下面使用正常的一维dp（无法拍扁成常量）
    function maxSubArrayV2 ($nums)
    {
        if (empty($nums)) return 0;
        $cou = count($nums);
        $dp = [];
        $dp[0] = $nums[0];
        for ($i = 1; $i < $cou; $i++) {
            $dp[$i] = max($nums[$i], $nums[$i] + $dp[$i-1]);
        }
        return max($dp);
    }

        /**
     * 输入: nums = [-2,1,-3,4,-1,2,1,-5,4] // [-2, 1, 1, 4, 3, 5, 6, 2, 5]
    输出: 6
    解释: 连续子数组 [4,-1,2,1] 的和最大，为 6。
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArrayFalse($nums)
    {
        $cou = count($nums);
        if (empty($cou)) return 0;
        if ($cou == 1) return $nums[0];

        $max = $nums[0];
        for ($i = 1; $i < $cou; $i++) {
            if ($max + $nums[$i] < 0) {
                if ($nums[$i] < 0) {
                    $max = 0;
                } else {
                    $max = $nums[$i];
                }
            } else {
                // 错误，因为子数组，当前可能小，但是下面元素相加可能比较大
                if ($max + $nums[$i] > $max) {
                    $max = $max + $nums[$i];
                }
            }
        }
        return $max;
    }
}

$a = [-2,1,-3,4,-1,2,1,-5,4];
$res = (new Solution())->maxSubArray($a);
var_dump($res);
