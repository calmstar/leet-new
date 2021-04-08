<?php

/**
 * 暴力法
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
                        $map[$k] = 1;
                    }
                }
            }
        }
    }
    return $res;
}

// 简化版本 -- 待修正
function threeSum2 ($nums)
{
    $cou = count($nums);
    if ($cou <= 2) return [];
    if ($nums[0] == 0 && $nums[1] == 0 && $nums[2] == 0 ) return [0,0,0];
    $res = [];
    $map = [];

    sort($nums);
    foreach ($nums as $k => $v) {
        if ($v > 0 || $v == $nums[$k-1]) {
            continue;
        }
        $tempRes = [];
        $tempRes = twoSum($nums, $k+1, abs($v));
        if (!empty($tempRes)) {
            foreach ($tempRes as $vv) {
                $a = [$nums[$k], $vv[0], $vv[1] ];
                sort($a);
                $kkk = implode(',', $a);
                if (!$map[$kkk]) {
                    $res[] = [$nums[$k], $vv[0], $vv[1] ];
                    $map[$kkk] = 1;
                }
            }
        }
    }
    return $res;
}

function twoSum ($nums, $begin, $target)
{
    $cou = count($nums);
    $map = [];
    $res = [];
    for ($i = $begin; $i < $cou; $i++) {
        $map[$nums[$i]] = $i;
    }
    for ($i = $begin; $i < $cou; $i++) {
        $temp = $target - $nums[$i];
        if (isset($map[$temp]) && $i != $map[$temp]) {
            // 收集所有可能的情况
            $res[] = [$nums[$i], $temp];
        }
    }
    return $res;
}

//$nums = [-2,0,1,1,2];
$nums =[0,0,0];
$res = threeSum2($nums);
var_dump($res);
/**
 * 输入：nums = [-1,0,1,2,-1,-4]
输出：[[-1,-1,2],[-1,0,1]]
 */

