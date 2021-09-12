<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/8
 * Time: 12:15
 */

/**
 *
 * 3. 无重复字符的最长子串
 *
 * 给定一个字符串，请你找出其中不含有重复字符的 最长子串 的长度。

示例 1:

输入: "abcabcbb"
输出: 3
解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
示例 2:

输入: "bbbbb"
输出: 1
解释: 因为无重复字符的最长子串是 "b"，所以其长度为 1。
示例 3:

输入: "pwwkew"
输出: 3
解释: 因为无重复字符的最长子串是 "wke"，所以其长度为 3。
     请注意，你的答案必须是 子串 的长度，"pwke" 是一个子序列，不是子串。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/longest-substring-without-repeating-characters
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {


    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        if (strlen($s) == 0) return 0;
        $arr = str_split($s); // 把字符串切割为数组；'123' --> [1,2,3]
        $subArr = [];
        $num = [];

        foreach ($arr as $k => $v) {
            if (in_array($v, $subArr)) { // 如果该字符存在$subArr中，则说明重复
                $num[] = count($subArr); // 把当前子序列的长度存储起来
                array_splice($subArr, 0, array_search($v, $subArr)+1); // 从 0 开始清空 至 子序列数组中对应重复的字符开始位置
            }
            $subArr[] = $v; // 将该字符存入到子序列数组中
        }
        // 最后一次的数组长度也需要记录
        $num[] = count($subArr);
        return max($num);
    }
}
/**
 * $index = array_search('a', [a,b,r,t]) ,则返回位置索引0
 *
 *
 *  $arr = [1,2,3];
    $x = array_slice($arr, 0, 1);
    var_dump($x, $arr); // [1] [1,2,3]
 *
    echo "---分割线\n";
 *
    $x = array_splice($arr, 0, 1);
    var_dump($x, $arr); // [1]  [2,3]
 *
 * 结论：
 *      array_slice 是值传递
 *      array_splice 是引用传值
 */



