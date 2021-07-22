<?php

class Solution {

    function minWindow($s, $t) {

    }

    /**
     * v1版本会超时
     * @param String $s
     * @param String $t
     * @return String
     */
    function minWindowV1($s, $t) {
        $len = strlen($s);
        $tlen = strlen($t);
        if ($len < $tlen) return '';

        $min = $len + 1;
        $minStr = '';
        // 循环得到所有子串
        for ($i = 0; $i < $len; $i++) {
            for ($j = $i; $j < $len; $j++) {
                $str = substr($s, $i, $j-$i+1);
                // 判断字符是否包含$t
                $res = $this->isIncludeV1($str, $t);
                if ($res && $min > strlen($str)) {
                    $min = strlen($str);
                    $minStr = $str;
                }
            }
        }
        return $minStr;
    }

     function isIncludeV1 ($big, $small)
    {
        $bLen = strlen($big);
        $len = strlen($small);
        if ($len > $bLen) {
            return false;
        }
        $bigArr = [];
        for ($j = 0; $j < $bLen; $j++) {
            $bigArr[] = $big[$j];
        }

        // 判断是否包含
        for ($i = 0; $i < $len; $i++) {
            $isHad = false;
            foreach ($bigArr as $k => $v) {
                if ($small[$i] == $v) {
                    $isHad = true;
                    unset($bigArr[$k]);
                    break;
                }
            }
            if (!$isHad) {
                return false;
            }
        }
        return true;
    }
}

$s = "ADOBECODEBANC";
$t = "ABC";
// 预期结果
//"BANC"

$res = (new Solution())->minWindowV1($s, $t);
//$res = (new Solution())->isInclude("BANC", "ABC");
var_dump($res);



