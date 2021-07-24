<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function sortArrayByParity($nums)
    {
        $cou = count($nums);
        if ($cou < 2) return $nums;
        // 双指针 -- 左右指针遍历交换
        // 所有偶数元素之后跟着所有奇数元素。
        $left = 0;
        $right = $cou - 1;
        while ($left < $right) {
            while (isset($nums[$left]) && $nums[$left] % 2 == 0) {
                // 遍历指向到奇数，待交换状态
                $left++;
            }
            while (isset($nums[$right]) && $nums[$right] % 2 == 1) {
                $right--;
            }
            if ($left >= $right) break;
            $temp = $nums[$left];
            $nums[$left] = $nums[$right];
            $nums[$right] = $temp;

            $left++;
            $right--;
        }
        return $nums;
    }
}
$res = (new Solution())->sortArrayByParity([0,4]);
var_dump($res);
