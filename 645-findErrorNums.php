<?php

class Solution {

    /**
     * https://mp.weixin.qq.com/s/o3GQ4fXjPkS04Sr9uPH8ZQ
     *
     * 集合 s 包含从 1 到 n 的整数。不幸的是，因为数据错误，
     * 导致集合里面某一个数字复制了成了集合里面的另外一个数字的值，
     * 导致集合 丢失了一个数字 并且 有一个数字重复 。
     *
     * 示例 1：
    输入：nums = [1,2,2,4]
    输出：[2,3]
     *
     * @param Integer[] $nums
     * @return Integer[]
     */
    function findErrorNums($nums)
    {
        $cou = count($nums);
        $repeat = -1;
        $missing = -1;

        for ($i = 0; $i < $cou; $i++) {
            $index = abs($nums[$i]) - 1; // 数字从1开始，索引从0开始，需要减1
            if ($nums[$index] < 0) {
                $repeat = abs($nums[$i]);
            } else {
                $nums[$index] *= -1;
            }
        }
        for ($i = 0; $i < $cou; $i++) {
            if ($nums[$i] > 0) $missing = $i + 1 ;
        }
        return [$repeat, $missing];
    }
}
$arr = [1,2,2,4];
$res = (new Solution())->findErrorNums($arr);
print_r($res);