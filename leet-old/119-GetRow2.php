<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/7
 * Time: 16:03
 */

/**
 * 给定一个非负索引 k，其中 k ≤ 33，返回杨辉三角的第 k 行。



在杨辉三角中，每个数是它左上方和右上方的数的和。

示例:

输入: 3
输出: [1,3,3,1]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/pascals-triangle-ii
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 * Class Solution
 */
class Solution {

    /**
    杨辉三角2 - 2020-03-07
     * @param Integer $rowIndex
     * @return Integer[]
     */
    function getRow($rowIndex) {
        $arr = [];
        for ($i = 0; $i <= $rowIndex; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                if (!isset($arr[$i-1][$j-1]) || !isset($arr[$i-1][$j]) ) {
                    $arr[$i][$j] = 1;
                } else {
                    $arr[$i][$j] = $arr[$i-1][$j-1] + $arr[$i-1][$j];
                }
            }

        }
        return array_pop($arr);
    }
}