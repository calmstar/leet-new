<?php
class Solution {

    /**
     * 时间复杂度：O(sp) ， s的长度 * p的长度
     * 空间复杂度：O(p)，p的空间大小
     *
     * labuladong 双指针套路解法
     * 相当于，输入一个串S，一个串T，找到S中所有T的排列，返回它们的起始索引。
     * @param String $s
     * @param String $p
     * @return Integer[]
     */
    function findAnagrams($s, $p) {
        $sLen = strlen($s);
        $pLen = strlen($p);
        $left = 0;
        $right = 0;
        $valid = 0;
        $need = [];
        $windowHad = [];
        // 初始化
        for ($i = 0; $i < $pLen; $i++) {
            if (!isset($need[$p[$i]])) {
                $need[$p[$i]] = 1;
            } else {
                $need[$p[$i]]++;
            }
        }
        $needSize = count($need);
        $res = [];

        // 滑动父串
        while ($right < $sLen) {
            // 增加右索引边界
            $rTmp = $s[$right];
            $right++;

            if ($need[$rTmp]) {
                $windowHad[$rTmp]++;
                if ($windowHad[$rTmp] == $need[$rTmp]) {
                    $valid++;
                }
            }

            //收缩左索引的情况
            while ($right-$left >= $pLen) {
                if ($valid == $needSize) {
                    $res[] = $left;
                }
                $lTmp = $s[$left];
                $left++;
                if ($need[$lTmp]) {
                    if ($need[$lTmp] == $windowHad[$lTmp]) {
                        $valid--;
                    }
                    $windowHad[$lTmp]--;
                }
            }
        }
        return $res;
    }
}

/**
 * 输入: s = "cbaebabacd", p = "abc"
输出: [0,6]
解释:
起始索引等于 0 的子串是 "cba", 它是 "abc" 的异位词。
起始索引等于 6 的子串是 "bac", 它是 "abc" 的异位词。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/find-all-anagrams-in-a-string
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

$s = "cbaebabacd";
$p = "abc";
$res = (new Solution())->findAnagrams($s, $p);
var_dump($res);