<?php
class Solution {

    /**
     * @param String $s
     * @param String $goal
     * @return Boolean
     */
    function rotateString($s, $goal) {
        if (strlen($s) != strlen($goal)) return false;
        $len = strlen($s);
        $s .= $s;
        for ($i = 0; $i < $len; $i++) {
            $temp = substr($s, $i, $len);
            if ($temp == $goal) {
                return true;
            }
        }
        return false;
    }
}
$a = "abcde";
$b = "abced";
$res = (new Solution())->rotateString($a, $b);
var_dump($res);