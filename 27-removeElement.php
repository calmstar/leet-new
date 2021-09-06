<?php

/**
 * 移除元素
 * 输入：nums = [3,2,2,3], val = 3
输出：2, nums = [2,2]
 *
解释：函数应该返回新的长度 2, 并且 nums 中的前两个元素均为 2。
 * 你不需要考虑数组中超出新长度后面的元素。例如，函数返回的新长度为 2 ，
 * 而 nums = [2,2,3,3] 或 nums = [2,2,0,0]，也会被视作正确答案。
 */
// php独有
function removeElement(&$nums, $val)
{
    foreach ($nums as $k => $v) {
        if ($v == $val) {
            unset($nums[$k]);
        }
    }
    return count($nums);
}

// 双指针 -- 快慢指针技巧
function removeElementV2(&$nums, $val)
{
    if (empty($nums)) return 0;
    $slow = 0;
    $fast = 0;
    $cou = count($nums);
    while ($fast < $cou) { // [0, slow]是符合规则的区域
        if ($nums[$fast] != $val) {
            $nums[$slow] = $nums[$fast]; // 将不等于val的值，全部移动到左边
            $slow++;
        }
        $fast++;
    }
    return $slow;
}