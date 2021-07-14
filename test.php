<?php
class Solution {
    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $len = strlen($s);
        if ($len < 2) return $len;
        // 以每个字母（$str[$i]）为中心向两边扩展，和 $str[$i]   $str[$i+1] 为中心向两边扩展
        $maxStr = '';
        for ($i = 0; $i < $len; $i++) {
            $res = $this->findPalindrome($i, $i, $str);
            $res2 = $this->findPalindrome($i, $i+1, $str);
            // 得到最长的回文子串
            $tmp = strlen($res) > strlen($res2) ? $res : $res2;
            $maxStr = strlen($maxStr) > strlen($tmp) ? $maxStr : $tmp;
        }
        return $maxStr;
    }

    function findPalindrome ($l, $r, $str)
    {
        $len = strlen($str);
        $flag = false;
        while ($l <= $r && $l >= 0 && $r < $len && $str[$l] == $str[$r]) {
            $l--;
            $r++;
            $flag = true;
        }
        // 还原回去
        $l = $l+1;
        $r = $r-1;
        if ($flag) {
            return substr($str, $l, $r-$l+1);
        } else {
            return '';
        }
    }

}
$sss = 'babad';
$res =(new Solution)->longestPalindrome($sss);
var_dump($res);