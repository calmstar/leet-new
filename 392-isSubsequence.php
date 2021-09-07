<?php
class Solution {

    /**
     * 判断子序列
     *
     * 输入：s = "abc", t = "ahbgdc"
    输出：true
     *
     * 输入：s = "axc", t = "ahbgdc"
    输出：false
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isSubsequence($s, $t)
    {
        $sLen = strlen($s);
        $tLen = strlen($t);
        $i = 0;
        $j = 0;
        while ($i < $sLen && $j < $tLen) {
            if ($s[$i] == $t[$j]) $i++;
            $j++;
        }
        return $i == $sLen;
    }
}