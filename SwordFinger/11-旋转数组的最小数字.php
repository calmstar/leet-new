<?php
class Solution {

    /**
     * 把一个数组最开始的若干个元素搬到数组的末尾，我们称之为数组的旋转。
     * 输入一个递增排序的数组的一个旋转，输出旋转数组的最小元素。
     * 例如，数组 [3,4,5,1,2] 为 [1,2,3,4,5] 的一个旋转，该数组的最小值为1。  

    输入：[3,4,5,1,2]
    输出：1
     *
     * 【5， 1，2，3，4】
     *
     * 二分查找思路
     * @param Integer[] $numbers
     * @return Integer
     */
    function minArray($numbers)
    {
        // 仍然有问题
        if (empty($numbers)) return -999;
        $cou = count($numbers);
        if ($cou == 1) return $numbers[0];
        $left = 0;
        $right = $cou - 1;

        // 如果本身没有旋转，则直接输出第一个
        if ($numbers[$left] < $numbers[$right]) {
            return $numbers[$left];
        }

        while ($left <= $right)
        {
            $mid = $left + intval(($right-$left)/2);
            if ($numbers[$mid] >= $numbers[0]) {
                // 仍然处于正常区间 -- 跟最左边相比，如果比0位置的元素大说明还在递增，否则在了旋转区间了
                $left = $mid+1;
            } else {
                // 试探前一个元素是否比自己大，如果大说明已经是在旋转区间的最左边，否则不是最左边，继续试探二分
                if ($numbers[$mid] < $numbers[$mid-1]) {
                    return $numbers[$mid];
                } else {
                    //
                    $right = $mid-1;
                }
            }
        }
        return $numbers[0];
    }

}

$a = [10,1,10,10,10];
$res = (new Solution())->minArray($a);
var_dump($res);

/**
 * 参考写法 todo
 * @param Integer[] $nums
 * @return Integer
 */
function findMin($nums) {
    $n = count($nums);
    $left = 0;
    $right = $n - 1;
    while ($left < $right) {
        if ($nums[$left] < $nums[$right]) return $nums[$left];

        $mid = $left + floor(($right - $left) / 2);
        if ($nums[$mid] > $nums[$right]) {
            // 中点严格大于右边界 搜索区间变为 [mid + 1, right]
            $left = $mid + 1;
        } elseif ($nums[$mid] === $nums[$right]) {
            // 只能排除一个右边界
            $right--;
        } else {
            // 中点严格小于右边界 搜索区间变为 [left, mid] 注意要包含中点
            $right = $mid;
        }
    }

    return $nums[$left];
}
