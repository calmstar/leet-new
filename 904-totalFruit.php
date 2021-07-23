<?php
class Solution {

    /**
     * @param Integer[] $fruits
     * @return Integer
     */
    function totalFruit($fruits) {
        $left = 0;
        $right = 0;
        $window = [];
        $cou = count($fruits);
        $max = 0;
        while ($right < $cou) {
            // 往右边扩展
            $rTmp = $fruits[$right];
            $right++;
            $window[$rTmp]++; // 存储hash状态

            // 种类大于两种，则开始进行左边收缩，收缩成符合条件
            while (count($window) > 2) {
                $lTmp = $fruits[$left];
                $left++;
                $window[$lTmp]--;// 变更hash状态
                if (!$window[$lTmp]) {
                    unset($window[$lTmp]);
                }
            }
            // 计算总和
            $total = 0;
            foreach ($window as $v) {
                $total += $v;
            }
            $max = max($max, $total);
        }
        return $max;
    }
}
$a = [0,1,2,2];
$res = (new Solution())->totalFruit($a);
var_dump($res);