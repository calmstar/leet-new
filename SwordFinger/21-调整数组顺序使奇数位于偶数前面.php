<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function exchange($nums)
    {
        $cou = count($nums);
        if ( $cou < 2) return $nums;
        $left = 0;
        $right = $cou - 1;
        //题目要求：左边奇数，右边偶数
        while ($left < $right) {
            if ($nums[$left] % 2 == 0) { // 左边偶数，需要交换。找到右边的奇数的第一个位置
                while ($right >= 0) {
                    if ($nums[$right] % 2 == 1) { // 右边奇数，找到交换位置
                        break;
                    }
                    $right--;
                }
                if ($right <= $left) break; // [2,4,6]情况
                $tmp = $nums[$left];
                $nums[$left] = $nums[$right];
                $nums[$right] = $tmp;
            }
            $left++;
        }
        return $nums;
    }
}
$a = [1,2,3,4];