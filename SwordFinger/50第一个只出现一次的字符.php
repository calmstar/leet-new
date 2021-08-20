<?php
class Solution {

    /**
     * s = "abaccdeff"
    返回 "b"
     * @param String $s
     * @return String
     */
    function firstUniqChar($s) {
        if (empty($s)) return ' ';
        $appearArr = [];
        $len = strlen($s);
        for ($i = 0; $i < $len; $i++) {
            if (isset($appearArr[$s[$i]])) {
                $appearArr[$s[$i]]++;
            } else {
                $appearArr[$s[$i]] = 1;
            }
        }
        foreach ($appearArr as $k => &$v) {
            if ($v > 1) {
                unset($appearArr[$k]);
            }
        }
        $resArr = array_keys($appearArr);
        for ($i = 0; $i < $len; $i++) {
            if (in_array($s[$i], $resArr)) {
                return $s[$i];
            }
        }
        return ' ';
    }
}
$a = "abaccdeff";
$res = (new Solution())->firstUniqChar($a);
var_dump($res);