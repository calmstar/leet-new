<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums) {
        $cou = count($nums);
        $zeroNum = 0;
        for ($i = 0; $i < $cou; $i++) {
            if (empty($nums[$i])) {
                $zeroNum++;
                unset($nums[$i]);
            }
        }
        while ($zeroNum) {
            array_push($nums, 0);
            $zeroNum--;
        }
    }
}