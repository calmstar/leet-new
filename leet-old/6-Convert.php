<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/13
 * Time: 11:00
 */

/**
 * 6. Z 字形变换
 *
 * 将一个给定字符串根据给定的行数，以从上往下、从左到右进行 Z 字形排列。

比如输入字符串为 "LEETCODEISHIRING" 行数为 3 时，排列如下：

L   C   I   R
E T O E S I I G
E   D   H   N
之后，你的输出需要从左往右逐行读取，产生出一个新的字符串，比如："LCIRETOESIIGEDHN"。

请你实现这个将字符串进行指定行数变换的函数：

string convert(string s, int numRows);
示例 1:

输入: s = "LEETCODEISHIRING", numRows = 3
输出: "LCIRETOESIIGEDHN"
示例 2:

输入: s = "LEETCODEISHIRING", numRows = 4
输出: "LDREOEIIECIHNTSG"
解释:

L     D     R
E   O E   I I
E C   I H   N
T     S     G

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/zigzag-conversion
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */


class Solution {

    /**
     * 二维数组方式
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        $len = strlen($s);
        if ($len == 1 && $len == $numRows) return $s;
        $arr = [];
        $sign = 'down';
        $pre = -1;
        for ($i = 0; $i < $len; $i++) {
            if ($sign == 'down') {
                // 方向向下
                $arr[++$pre][] = $s[$i];
                // 到底部了，改方向为向上
                if ($pre == $numRows-1) $sign = 'up';
            } else {
                // 方向向上
                $arr[--$pre][] = $s[$i];
                // 到顶部了，改方向为向下
                if ($pre == 0) $sign = 'down';
            }
        }
        // 整理为字符串
        $resStr = '';
        foreach ($arr as $v) {
            foreach ($v as $vv) {
                $resStr .= $vv;
            }
        }
        return $resStr;
    }
}

$s = new Solution();
$str = 'LEETCODEISHIRING';
$res = $s->convert($str,3);
var_dump($res);