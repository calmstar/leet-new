<?php

class Solution {

    /**
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