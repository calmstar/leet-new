<?php

class Solution {

    /**
     * labuladong 套路双指针滑动窗口解法
     * @param $s1
     * @param $s2
     * @return bool
     */
    function checkInclusion ($s1, $s2)
    {
        $s1Len = strlen($s1);
        $s2Len = strlen($s2);
        $need = [];
        $windowHad = [];
        $left = 0; // [$left, $right) 左开右闭
        $right = 0;
        $valid = 0;

        // 初始化所需要拼凑的字符串
        for ($i = 0; $i < $s1Len; $i++) {
            if (!isset($need[$s1[$i]])) {
                $need[$s1[$i]] = 1;
            } else {
                $need[$s1[$i]]++;
            }
        }
        $needSize = count($need);

        while ($right < $s2Len) {
            // 获取右边即将获得的字符
            $rTmp = $s2[$right];
            $right++;
            if ($need[$rTmp]) {
                $windowHad[$rTmp]++;
                if ($need[$rTmp] == $windowHad[$rTmp]) {
                    $valid++;
                }
            }

            // 右边大于左边两个位置时，需要移动左边索引
            while ($right-$left >= $s1Len) {
                if ($valid == $needSize) {
                    return true;
                }

                // 获取即将抛弃的左边的字符
                $lTmp = $s2[$left];
                $left++;
                // 看收缩抛弃的字符是否在$need中
                if ($need[$lTmp]) {
                    if ($windowHad[$lTmp] == $need[$lTmp] ) {
                        $valid--;
                    }
                    $windowHad[$lTmp]--;
                }
            }
        }
        return false;
    }

    /**
     * 自己想的滑动窗口解法
     * @param String $s1
     * @param String $s2
     * @return Boolean
     */
    function checkInclusionV2 ($s1, $s2)
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

$a = "ab";
$b = "eidbaooo";
//$a = "adc";
//$b = "dcda";
$res = (new Solution())->checkInclusion($a, $b);
var_dump($res);