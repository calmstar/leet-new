<?php
class Solution {

    /**
     * @param String $s
     * @param Integer $n
     * @return String
     */
    function reverseLeftWords($s, $n) {
        $a = substr($s, 0, $n);
        $b = substr($s, $n);
        return  $b . $a;
    }
}
$s = 'abcdefg';
$res = (new Solution())->reverseLeftWords($s, 2);
var_dump($res);
