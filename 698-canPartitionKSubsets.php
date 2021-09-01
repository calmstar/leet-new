<?php

class Solution {

    /**
     * https://mp.weixin.qq.com/s/fsLKaWBvSWtM0jA-CfOxyA
     * 698. 划分为k个相等的子集
    给定一个整数数组  nums 和一个正整数 k，找出是否有可能把这个数组分成 k 个非空子集，其总和都相等。
    输入： nums = [4, 3, 2, 3, 5, 2, 1], k = 4
    输出： True
    说明： 有可能将其分成 4 个子集（5），（1,4），（2,3），（2,3）等于总和。

     * @param Integer[] $nums
     * @param Integer $k
     * @return Boolean
     */
    function canPartitionKSubsets($nums, $k)
    {
        if ($k > count($nums)) return false;
        $sum = array_sum($nums);
        if ($sum % $k != 0) return false; // 不能正整除，小数，false
        $target = $sum / $k;

        rsort($nums);
        $bucket = []; // k个桶
        $index = 0; // nums的索引位置，从0开始
        return  $this->backTracking($nums, $k, $target, $bucket, $index);
    }
    // 回溯算法：穷举所有可能，站在数字角度，看怎么选择桶
    function backTracking ($nums, $k, $target, $bucket, $index)
    {
        // baseCase
        if ($index == count($nums)) {
            // 迭代完了所有数字，判断此次桶的选择的是否符合
            if (count($bucket) != $k) return false;
            foreach ($bucket as $v) {
                if ($v != $target) return false;// 有一个桶的数字和不符合需求
            }
            return true;
        }
        // 穷举桶
        for ($i = 0; $i < $k; $i++) {
            // 剪枝：桶大小已经超过目标值 -- 优化，前面对$nums数组排序，让大的数字排在前面，更容易触发此if条件剪枝
            if ($bucket[$i] + $nums[$index] > $target) continue;
            // 做选择
            $bucket[$i] += $nums[$index];
            $res = $this->backTracking($nums, $k, $target, $bucket, $index+1);
            if ($res) return true; // 说明到达了index的最后一个位置，数字遍历完，且组合正确
            // 撤销选择
            $bucket[$i] -= $nums[$index];
        }
        return false;
    }

    // 题外话遍历数组的两种方式：for循环 和 递归。递归：
    function traverse ($nums, $index)
    {
        if ($index >= count($nums)) return;
        echo $nums[$index];
        $this->traverse($nums, $index+1);
    }


    // -------- 错误解法：可能存在几个数字的组合 ----------
    function canPartitionKSubsetsWrong($nums, $k)
    {
        $sum = array_sum($nums);
        if ($sum % $k != 0) return false; // 不能正整除，小数，false
        $targetSum = $sum / $k;
        $hash = [];
        $cou = count($nums);
        for ($i = 0; $i < $cou; $i++) {
            if (isset($hash[$nums[$i]])) {
                $hash[$nums[$i]]++;
            } else {
                $hash[$nums[$i]] = 1;
            }
        }
        for ($i = 0; $i < $cou; $i++) { //[1,1,1,1,2,2,2,2];
            $tmp = abs($targetSum - $nums[$i]);
            if ($tmp == 0) {
                $hash[$nums[$i]]--;
                continue;
            }
            if (isset($hash[$tmp]) && $hash[$tmp] > 0) {
                $hash[$tmp]--;
            } else {
                return false;
            }
        }
        foreach ($hash as $v) {
            if ($v > 0) return false;
        }
        return true;
    }

}

$nums = [4, 3, 2, 3, 5, 2, 1];
$k = 4;

//$nums = [2,2,2,2,3,4,5];
//$k = 4;
//
//$nums = [1,1,1,1,2,2,2,2];
//$k = 2;

$res = (new Solution())->canPartitionKSubsets($nums, $k);
var_dump($res);