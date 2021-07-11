<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Boolean
     */
    function containsNearbyDuplicate($nums, $k) {
        if (count($nums) < 2) return false;

        $map = [];
        foreach ($nums as $key => $v) {
            if (isset($map[$v]) &&  $key - $map[$v] <= $k) {
                return true;
            } else {
                $map[$v] = $key;
            }
            // 不能直接使用 array_shift的方式，会使得键名被重置为数字顺序
            // if (count($map) > $k) {
            //     array_shift($map);
            // }
        }
        return false;

    }
}