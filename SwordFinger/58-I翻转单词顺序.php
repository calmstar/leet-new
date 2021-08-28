<?php
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function reverseWords($s)
    {
        if (empty($s)) return $s;
        $arr = explode(' ', $s);
        $cou = count($arr);
        $str = '';
        for ($i = $cou-1; $i >= 0; $i--) {
            if (empty($arr[$i])) continue;
            $str .= $arr[$i] . ' ';
        }
        return trim($str, ' ');
    }
}
$a = "the sky is blue";
$res = (new Solution())->reverseWords($a);
var_dump($res);