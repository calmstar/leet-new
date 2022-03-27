<?php

class interArr
{
    /**
     * 求2个有序数组的交集, 第一个数组长度 n, 第二个数组长度 m
     * 1  3  4  5  6
     * 1  3  5  7  9
    答案是  1 3 5
     */
    function getInterArr ($nums1, $nums2)
    {
        if (empty($nums1) || empty($nums2)) return [];
        $current1 = 0;
        $current2 = 0;
        $interPoint = -1;
        while ( isset($nums1[$current1]) && isset($nums2[$current2]) ) {
            if ($nums1[$current1] == $nums2[$current2]) {
                $interPoint++;
                if ($interPoint != $current1) {
                    // 复制过来
                    $nums1[$interPoint] = $nums1[$current1];
                }
                $current1++;
                $current2++;
            } else if ($nums1[$current1] > $nums2[$current2]) {
                $current2++;
            } else {
                $current1++;
            }
        }
        return $interPoint == -1 ? [] : array_slice($nums1, 0, $interPoint+1);
    }

}

$a = [1,  3 , 5 , 7,  9];
$b = [1,  3 , 4 , 5,  6];
$res = (new interArr())->getInterArr($b, $a);
var_dump($res);