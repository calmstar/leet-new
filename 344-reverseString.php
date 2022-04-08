<?php
class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString (&$s) {
        $len = count($s);
        if ($len <= 1) return $s;
        $left = 0;
        $right = $len - 1;
        while ($left <= $right) {
            $temp = $s[$left];
            $s[$left] = $s[$right];
            $s[$right] = $temp;
            $left++;
            $right--;
        }
    }

}