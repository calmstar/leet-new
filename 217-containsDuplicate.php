<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate($nums) {
        if (count($nums) < 2) return false;
        $map = [];
        foreach ($nums as $v) {
            if (isset($map[$v])) {
                return true;
            } else {
                $map[$v] = 1;
            }
        }
        return false;

    }
}