<?php
class Solution {

    /**
     * [
    [1,   4,  7, 11, 15],
    [2,   5,  8, 12, 19],
    [3,   6,  9, 16, 22],
    [10, 13, 14, 17, 24],
    [18, 21, 23, 26, 30]
    ]


     * @param Integer[][] $matrix
     * @param Integer $target
     * @return Boolean
     */
    function findNumberIn2DArray($matrix, $target)
    {
        if (empty($matrix)) return false;
        $cou = count($matrix);
        for ($i = 0; $i < $cou; $i++) {
            $res = $this->binarySearch($matrix[$i], $target);
            if ($res) return true;
        }
        return false;
    }

    function binarySearch ($arr, $target)
    {
        $cou = count($arr);
        $left = 0;
        $right = $cou - 1;
        while ($left <= $right) {
            $mid = $left + intval(($right-$left)/2);
            if ($arr[$mid] == $target) {
                return true;
            }elseif ($arr[$mid] < $target) {
                $left = $mid+1;
            } else {
                $right = $mid-1;
            }
        }
        return false;
    }

}