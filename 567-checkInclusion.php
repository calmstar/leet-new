<?php

class Solution {

    /**
     * @param String $s1
     * @param String $s2
     * @return Boolean
     */
    function checkInclusion ($s1, $s2)
    {
        $s1Len = strlen($s1);
        $s2Len = strlen($s2);
        $left = 0;
        $right = $s1Len-1;
        while ($right < $s2Len) {
            $temp = substr($s2, $left, $s1Len);
            // 判断是否相等
            $res = $this->check($temp, $s1);
            if ($res) return true;
            $left++;
            $right++;
        }
        return false;
    }

    // 判断两个字符串的排列是否相等
    function check ($temp, $t)
    {
        $cou = strlen($temp);
        $map = [];
        for ($i = 0; $i < $cou; $i++) {
            if (!isset($map[$temp[$i]])) {
                $map[$temp[$i]] = 1;
            } else {
                $map[$temp[$i]] = $map[$temp[$i]] + 1;
            }
            if (!isset($map[$t[$i]])) {
                $map[$t[$i]] = -1;
            } else {
                $map[$t[$i]] = $map[$t[$i]] - 1;
            }
            // 如果为0，置为空
            if ($map[$temp[$i]] === 0) {
                unset($map[$temp[$i]]);
            }
            if ($map[$t[$i]] === 0) {
                unset($map[$t[$i]]);
            }
        }
        if (empty($map)) {
            return true;
        } else {
            return false;
        }
    }
}

//$a = "ab";
//$b = "eidbaooo";
$a = "adc";
$b = "dcda";
$res = (new Solution())->checkInclusion($a, $b);
var_dump($res);