<?php

class Solution {

    // labuladong : https://mp.weixin.qq.com/s/ioKXTMZufDECBUwRRp3zaA
    function minWindow($s, $t) {
        $need = []; // 需要凑齐的字符及数量，哈希
        $windowHad = []; // 当前窗口中含有的 凑齐字符及数量，哈希
        $tLen = strlen($t);
        $sLen = strlen($s);
        // 初始化需要凑齐的字符及其数量
        for ($i = 0; $i < $tLen; $i++) {
            if (!isset($need[$t[$i]])) {
                $need[$t[$i]] = 1;
            } else {
                $need[$t[$i]]++;
            }
        }
        $needSize = count($need); // 去重后的字符数量
        $left = 0; // 滑动窗口最左端
        $right = 0; // 滑动窗口最右端
        $start = 0; // 最短字符串的开始位置
        $len = $sLen+1; // 最短字符串长度，假设为无限大
        $valid = 0; // window中已凑齐的字符数量，如果跟 $valid==count($need),则表示[$left, $right)区间的字符已满足要求

        // 开始滑动窗口,[$left, $right) 左闭右开
        while ($right < $sLen) {
            // 获得将要加入的最右边字符
            $rTmp = $s[$right];
            $right++;
            // 如果是待凑齐的字符的话，修改窗口值
            if ($need[$rTmp]) {
                // 当前进入窗口区间的字符属于目标字符，则window++
                $windowHad[$rTmp]++;
                if ($need[$rTmp] == $windowHad[$rTmp]) {
                    // 如果窗口的这个字符数量，和要求的数量一致的话，则$valid++;
                    $valid++;
                }
            }

            // 当窗口满足需要字符条件的时候，左边开始一直收缩
            while ($valid == $needSize) {
                // 开始收缩，因为窗口中的字符已经包含了所需要的目标字符
                if ($right-$left < $len) {
                    // 当前满足的窗口的长度如果比原来的更小，则进行更新最小长度
                    $len = $right-$left;
                    $start = $left;
                }
                // 获得将要抛弃的左边字符
                $lTmp = $s[$left];
                $left++;
                // 如果属于需要凑齐的字符
                if ($need[$lTmp]) {
                    // 如果窗口中含有的字符数量 刚好等于 需要凑齐字符的数量，则该字符变成不满足状态，$valid需要减少
                    if ($need[$lTmp] == $windowHad[$lTmp]) {
                        $valid--;
                    }
                    // 如果属于需要凑齐的字符，必须把当前窗口含有的值进行自减
                    $windowHad[$lTmp]--;
                }
            }
        }
        return $len == $sLen+1 ? '' : substr($s, $start, $len);
    }

    // --------------- ---------------

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
// A D O B E C O D E B A  N  C
// 0 1 2 3 4 5 6 7 8 9 10 11 12
/**
 * 0 6   : A D O B E C
 * 1 11  : D O B E C O D E B A  N
 * 2 12
 */
//$s = "ADOBECODEBANC";
//$t = "ABC";
$s = "a";
$t = "aa";
// 预期结果
//"BANC"

$res = (new Solution())->minWindow($s, $t);
var_dump($res);



