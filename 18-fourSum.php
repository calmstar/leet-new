<?php

class Solution {
    /**
     * 四数之和
     * 给你一个由 n 个整数组成的数组 nums ，和一个目标值 target 。
     * 请你找出并返回满足下述全部条件且不重复的四元组 [nums[a], nums[b], nums[c], nums[d]] ：
     *
     * 输入：nums = [1,0,-1,0,-2,2], target = 0
    输出：[[-2,-1,1,2],[-2,0,0,2],[-1,0,0,1]]

     */

    /**
     * 暴力法：O(n4) 超时但正确
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[][]
     */
    function fourSum($nums, $target) {
        $cou = count($nums);
        if ($cou < 4) return [];
        $res= [];
        $map = [];

        for ($i = 0; $i < $cou; $i++) {
            for ($j = $i+1; $j < $cou; $j++) {
                for ($k = $j+1; $k < $cou; $k++) {
                    for ($l = $k+1; $l < $cou; $l++) {
                        if ( ($nums[$i] + $nums[$j] + $nums[$k] + $nums[$l]) == $target ) {
                            $temp = [$nums[$i], $nums[$j], $nums[$k], $nums[$l]];
                            sort($temp);
                            $key = implode($temp, ',');
                            if (!$map[$key]) {
                                $res[] = $temp;
                                $map[$key] = 1;
                            }
                        }
                    }
                }
            }
        }
        return $res;
    }

    // ------------------- 分割线 ---------------

    /**
     * 哈希法，空间换时间，使得O(n4)变为O(n3)
     *
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[][]
     */
    function fourSumV2 ($nums, $target) {
        $cou = count($nums);
        if ($cou < 4) return [];
        $res = [];
        $map = [];

        // 哈希
        $mapNum = [];
        foreach ($nums as $k => $v) {
            $mapNum[$v] = $k;
        }

        for ($i = 0; $i < $cou; $i++) {
            for ($j = $i+1; $j < $cou; $j++) {
                for ($k = $j+1; $k < $cou; $k++) {
                    $tempNum = $target - $nums[$i] - $nums[$j] - $nums[$k];
                    if ( isset($mapNum[$tempNum]) && $mapNum[$tempNum] != $i && $mapNum[$tempNum] != $j && $mapNum[$tempNum] != $k ) {
                        $temp = [$nums[$i], $nums[$j], $nums[$k], $tempNum];
                        sort($temp);
                        $key = implode($temp, ',');
                        if (!$map[$key]) {
                            $res[] = $temp;
                            $map[$key] = 1;
                        }
                    }
                }
            }
        }
        return $res;
    }


}