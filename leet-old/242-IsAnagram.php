<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/5
 * Time: 15:29
 */

/**
 * 给定两个字符串 s 和 t ，编写一个函数来判断 t 是否是 s 的字母异位词。

示例 1:

输入: s = "anagram", t = "nagaram"
输出: true
示例 2:

输入: s = "rat", t = "car"
输出: false
说明:
你可以假设字符串只包含小写字母。

进阶:
如果输入字符串包含 unicode 字符怎么办？你能否调整你的解法来应对这种情况？

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/valid-anagram
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t) {
        $sLen = strlen($s);
        $tLen = strlen($t);
        if ($sLen != $tLen) return false;

        $arr = [];
        for ($i = 0; $i < $sLen; $i++) {
            $arr[$s[$i]]++;
        }

        for ($i = 0; $i < $sLen; $i++) {
            $key = $t[$i];
            if (!isset($arr[$key]) || $arr[$key] == 0 ) return false;
            if (isset($arr[$key])) $arr[$key]--;
        }
        return true;
    }

    function solveGod ($s, $t)
    {
        return count_chars($s, 1) == count_chars($t, 1);
    }
}