<?php

/**
 * 给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。

有效字符串需满足：

左括号必须用相同类型的右括号闭合。
左括号必须以正确的顺序闭合。
注意空字符串可被认为是有效字符串。

示例 1:

输入: "()"
输出: true
示例 2:

输入: "()[]{}"
输出: true
示例 3:

输入: "(]"
输出: false
示例 4:

输入: "([)]"
输出: false
示例 5:

输入: "{[]}"
输出: true

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/valid-parentheses
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s) {
        $len = strlen($s);
        if ($len == 1)  return false;

        $left = array('(', '{', '[');
        $map = ['(' => ')', '{' => '}', '[' => ']'];
        $stack = [];

        // 默认都匹配正确
        $flag = true;

        for ($i = 0; $i < $len; $i++) {
            if (in_array($s[$i], $left)) {
                // 压入栈中
                array_push($stack, $s[$i]);
            } else {
                // 取出栈中元素
                $res = $map[array_pop($stack)] == $s[$i] ? true : false;
                if (!$res) {
                    $flag = false;
                    break;
                }
            }
        }

        if ($flag && empty($stack)) {
            return true;
        } else {
            return false;
        }
    }
}


$solu = new Solution();
//$s = '()[]{}';
$s = "((";
$s = "(";
var_dump($solu->isValid($s));