<?php
class Solution {

    /**
     * https://leetcode-cn.com/problems/smallest-k-lcci/
     * 最小堆实现
     * @param Integer[] $arr
     * @param Integer $k
     * @return Integer[]
     */
    function smallestK($arr, $k) {
        $minHeap = new SplMinHeap();
        foreach ($arr as $item) {
            $minHeap->insert($item);
        }
        $res = [];
        while (count($res) < $k) {
            $res[] = $minHeap->extract();
        }
        return $res;
    }
}
$arr = [1,3,5,7,2,4,6,8];
$k = 4;
$res = (new Solution())->smallestK($arr, $k);
var_dump($res);