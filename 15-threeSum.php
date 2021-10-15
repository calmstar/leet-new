<?php

/**
 * 给你一个包含 n 个整数的数组 nums，判断 nums 中是否存在三个元素 a，b，c ，
 * 使得 a + b + c = 0 ？请你找出所有和为 0 且不重复的三元组。
注意：答案中不可以包含重复的三元组。
 *
 * 给定数组 nums = [-1, 0, 1, 2, -1, -4]，
满足要求的三元组集合为：[ [-1, 0, 1], [-1, -1, 2] ]
 */

/**
 * 暴力法, O(n3)
 * 超时但正确
 * @param $nums
 * @return array
 */
function threeSum($nums) {
    $cou = count($nums);
    if ($cou <= 2) return [];
    $res = [];
    $map = [];

    for ($i = 0; $i < $cou-2; $i++) {
        for ($j = $i+1; $j < $cou - 1;$j++) {
            for ($k = $j + 1; $k < $cou; $k++) {
                if ( ($nums[$i] + $nums[$j] + $nums[$k]) == 0 ) {
                    $temp = [$nums[$i], $nums[$j], $nums[$k]];
                    sort($temp);
                    $key = implode(',', $temp);
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

// -------------------- 分割线 ----------------

/**
 * 哈希法，空间换时间，使得O(n3)变为O(n2)
 * 不会超时
 */
function threeSumV2 ($nums) {
    $cou = count($nums);
    if ($cou <= 2) return [];
    $res = [];
    $map = [];

    // 哈希
    $mapNum = [];
    foreach ($nums as $k => $v) {
        $mapNum[$v] = $k;
    }

    for ($i = 0; $i < $cou-2; $i++) {
        for ($j = $i+1; $j < $cou - 1;$j++) {
            $tempNum = 0 - $nums[$i] - $nums[$j];
            if ( isset($mapNum[$tempNum]) && $mapNum[$tempNum] != $i && $mapNum[$tempNum] != $j ) {
                $temp = [ $nums[$i], $nums[$j], $tempNum ];
                sort($temp);
                $key = implode(',', $temp);
                if (!$map[$key]) {
                    $res[] = $temp;
                    $map[$key] = 1;
                }
            }
        }
    }
    return $res;
}

