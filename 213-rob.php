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


}