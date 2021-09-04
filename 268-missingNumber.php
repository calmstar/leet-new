<?php

/**
 *
 * https://mp.weixin.qq.com/s/CVHfkEiIG3KTw65Z7FLGXg
 *
 * 给定一个包含 [0, n] 中 n 个数的数组 nums ，找出 [0, n] 这个范围内没有出现在数组中的那个数。

 * 输入：nums = [3,0,1]
输出：2
解释：n = 3，因为有 3 个数字，所以所有的数字都在范围 [0,3] 内。2 是丢失的数字，因为它没有出现在 nums 中。

 */
class Solution {

    /**
     * 1 位运算 : 数字和0异或等于本身；自己和自己异或等于0
     * 2 等差数列求和相减法
     * @param Integer[] $nums
     * @return Integer
     */
    function missingNumber($nums)
    {
        $n = count($nums);
        $res = 0;
        $nums[$n] = 0; // 补充一位，默认位0
        for ($i = 0; $i <= $n; $i++) {
            $res = $res ^ $i ^ $nums[$i];
        }
        return $res;
    }

}