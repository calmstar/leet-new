<?php

/**
 * 给定一个数组 nums，编写一个函数将所有 0 移动到数组的末尾，
 * 同时保持非零元素的相对顺序。
示例:
输入: [0,1,0,3,12]
输出: [1,3,12,0,0]
说明:
必须在原数组上操作，不能拷贝额外的数组。 尽量减少操作次数。
 *
 * 双指针法
 * @param $nums
 * @return array
 */
function moveZero ($nums): array
{
    $cou = count($nums);
    if ($cou == 0) return $nums;

    $left = 0;
    $right = $cou - 1;
    while ($left <= $right) {
        if ($nums[$left] == 0) {
            // left交换到right元素，然后把元素一个个往前移到前一个格
            $tmpLeft = $left;
            while ($tmpLeft < $right) {
                $nums[$tmpLeft] = $nums[$tmpLeft + 1];
                $tmpLeft++;
            }
            $nums[$right] = 0;
            $right--;
        } else {
            $left++;
        }
    }
    return $nums;
}
$a = [0,1,0,3,12];
$res = moveZero($a);
var_dump($res);