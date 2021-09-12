<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/27
 * Time: 10:58
 */

/**
 * 给定两个有序整数数组 nums1 和 nums2，将 nums2 合并到 nums1 中，使得 num1 成为一个有序数组。

说明:

初始化 nums1 和 nums2 的元素数量分别为 m 和 n。
你可以假设 nums1 有足够的空间（空间大小大于或等于 m + n）来保存 nums2 中的元素。
示例:

输入:
nums1 = [1,2,3,0,0,0], m = 3
nums2 = [2,5,6],       n = 3

输出: [1,2,2,3,5,6]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/merge-sorted-array
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n) {
        $nums1Cou = count($nums1);
        // 去除m位数后多余部分
        for ($b = $m; $b < $nums1Cou; $b++) {
            unset($nums1[$b]);
        }
        // 合并在$nums1数组中
        $t = count($nums1);
        foreach ($nums2 as $v) {
            $nums1[$t] = $v;
            $t++;
        }
        sort($nums1);
        return $nums1;
//        return $this->bubbleSort($nums1);

    }

    function bubbleSort (&$nums1) {
        // 冒泡
        $cou = count($nums1);
        if ($cou <= 1) return $nums1;
        for ($i = 0; $i < $cou-1; $i++) {
            // 一个冒泡都没有产生
            $noExchange = true;
            for ($j = 0; $j < $cou-$i-1; $j++) {
                if ($nums1[$j] > $nums1[$j+1]) {
                    $temp = $nums1[$j];
                    $nums1[$j] = $nums1[$j+1];
                    $nums1[$j+1] = $temp;
                    $noExchange = false; // 产生了冒泡
                }
            }
            if ($noExchange) {
                break;
            }
        }
        return $nums1;
    }
}

$s = new Solution();
$nums1 = [1,2,3,0,0,0];
$m = 3;
$nums2 = [2,5,6];
$n = 3;
var_dump($s->merge($nums1, $m, $nums2, $n));

/**
[0,1,1,2,2,0,0,0]
5
[0,3,3]
3
 */