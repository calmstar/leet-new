<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/6
 * Time: 12:02
 */

/**
 * 给定一个非负整数 numRows，生成杨辉三角的前 numRows 行。



在杨辉三角中，每个数是它左上方和右上方的数的和。

示例:

输入: 5
输出:
[
[1],
[1,1],
[1,2,1],
[1,3,3,1],
[1,4,6,4,1]
]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/pascals-triangle
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     * @param Integer $numRows
     * @return Integer[][]
     */
    function generate($numRows) {
        $arr = [];
        // $i 决定行数；$j 决定每行有多少个数据，及具体的数据值
        for ($i = 0; $i < $numRows; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                if (!isset($arr[$i-1][$j-1]) || !isset($arr[$i-1][$j])){
                    $arr[$i][$j] = 1;
                } else {
                    // 当前 i行j列 的数据，由（$i-1行$j-1列 ）+ （$i-1行$j列） 决定
                    $arr[$i][$j] = $arr[$i-1][$j-1] + $arr[$i-1][$j];
                }
            }
        }
        return $arr;
    }
}