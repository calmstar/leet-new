<?php


/**
 * https://mp.weixin.qq.com/s/Eb6ewVajH56cUlY9LetRJw
 *
 * . 区间列表的交集
 * ：firstList = [[0,2],[5,10],[13,23],[24,25]],
 * secondList = [[1,5],[8,12],[15,24],[25,26]]
输出：[[1,2],[5,5],[8,10],[15,23],[24,24],[25,25]]
 *
 * 输入：firstList = [[1,7]], secondList = [[3,10]]
输出：[[3,7]]
 *
 * 输入：firstList = [], secondList = [[4,8],[10,12]]
输出：[]
 */

class Solution {

    /**
     * @param Integer[][] $firstList
     * @param Integer[][] $secondList
     * @return Integer[][]
     */
    function intervalIntersection($firstList, $secondList)
    {
        if (empty($firstList) || empty($secondList)) return [];
        $i = 0;
        $j = 0;
        $res = [];
        while ($i < count($firstList) && $j < count($secondList)) {
            $f1 = $firstList[$i][0];
            $f2 = $firstList[$i][1];
            $s1 = $secondList[$j][0];
            $s2 = $secondList[$j][1];
            // 判断是否相交 (不相交：(f2<s1 || s2<f1) 取反 )
            if ($f2 >= $s1 && $s2 >= $f1) {
                $left = max($f1, $s1);
                $right = min($f2, $s2);
                // 加入结果
                $res[] = [$left, $right];
            }
            // 指针偏移
            if ($f2 > $s2) {
                $j++;
            } else {
                $i++;
            }
        }
        return $res;
    }
}
$firstList = [[1,7]];
$secondList = [[3,10]];
$res = (new Solution())->intervalIntersection($firstList, $secondList);
var_dump($res);
