<?php
class Solution {

    /**
     * 在198的基础上，增加环形的概念
     * https://mp.weixin.qq.com/s/z44hk0MW14_mAQd7988mfw
     * @param Integer[] $nums
     * @return Integer
     */
    function rob($nums)
    {
        $cou = count($nums) - 1;
        if ($cou == 0) return $nums[0];
        return max($this->robRange($nums, 0, $cou-1),
            $this->robRange($nums, 1, $cou));
    }
    function robRange ($nums, $start, $end)
    {
        $dp1 = 0;
        $dp2 = 0;
        $dp = 0;
       for ($i = $end; $i >= $start; $i--) {
           $dp = max($dp1, $dp2 + $nums[$i]);
           $dp2 = $dp1;
           $dp1 = $dp;
       }
       return $dp;
    }

    // --------- 自己想的 -----
    function rob2 ($nums)
    {
        $cou = count($nums);
        if ($cou == 1) return $nums[0];
       return max(
           $this->dp2(array_slice($nums, 0, $cou-1)),
           $this->dp2(array_slice($nums, 1, $cou-1))
       );
    }

    function dp2 ($nums)
    {
        $cou = count($nums);
        if ($cou == 1) return $nums[0];
        if ($cou == 2) return max($nums[0], $nums[1]);

        $dp = [];
        $dp[0] = $nums[0];
        $dp[1] = max($nums[0], $nums[1]);
        for ($i = 2; $i < $cou; $i++) {
            $dp[$i] = max(
                $dp[$i-1],
                $dp[$i-2] + $nums[$i]
            );
        }
        return $dp[$cou-1];
    }

}

$nums = [2,3,2];
$res = (new Solution())->rob2($nums);
var_dump($res);