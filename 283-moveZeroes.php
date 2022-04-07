<?php

class Solution {

    /**
     * 另外的解法：/Users/starchen/code/leet-new/za/富途/moveZero.php
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums) {
        $cou = count($nums);
        $zeroNum = 0;
        for ($i = 0; $i < $cou; $i++) {
            if (empty($nums[$i])) {
                $zeroNum++;
                unset($nums[$i]);
            }
        }
        while ($zeroNum) {
            array_push($nums, 0);
            $zeroNum--;
        }
    }

    /**
     * 双指针法 https://mp.weixin.qq.com/s/Z-oYzx9O1pjiym6HtKqGIQ
     * [0, slow] 是非0的元素区间，即slow指针维护非0区域，fast指针遍历
     * [0,1,4,0,2] =》 [1,4,2,0,0]
     * @param $nums
     * @return void
     */
    function moveZeroesV2 (&$nums)
    {
        $cou = count($nums);
        if (empty($cou)) return $nums;
        $slow = $fast = 0;
        while ($fast < $cou) {
            if ($nums[$fast] != 0) {
                $nums[$slow] = $nums[$fast];
                $slow++;
            }
            $fast++;
        }
        // 后面的数字修改为0
        while ($slow < $cou) {
            $nums[$slow] = 0;
            $slow++;
        }
    }

}

/**
// 指针指向法
class Solution {
function moveZeroes(&$nums) {
    $cou = count($nums);
    // i指针每次都移动。。j指针在数字为0的地方停下来，用于跟i指针指向的非0数字进行替换
    for ($i = 0,$j = 0; $i < $cou; $i++) {
        if ($nums[$i] !== 0) {
            $nums[$j] = $nums[$i];
            $j++;
        }
    }
    // 把从$j到后面的数字全部置为0
    for ($i = $j; $i < $cou; $i++) {
        $nums[$i] = 0;
    }

}
}
 */