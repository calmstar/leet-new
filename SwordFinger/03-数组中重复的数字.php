<?php
class Solution {

    /**
     *
     * @param Integer[] $nums
     * @return Integer
     */
    function findRepeatNumber($nums) {
        if(empty($nums)) return ;
        $newArr = [];
        foreach ($nums as $num) {
            if (isset($newArr[$num])) return $num;
            $newArr[$num] = 1;
        }
        return;
    }
}