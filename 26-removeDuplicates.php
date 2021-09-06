<?php

// php特有的方法，不涉及数组的元素搬移
function removeDuplicates(&$nums) {
    $val = '';
    foreach ($nums as $k => $v) {
        if ($val !== '' && $v == $val) {
            // 需要移除
            $val = $v;
            unset($nums[$k]);
            continue;
        }
        $val = $v;
    }
    return count($nums);
}

// 快慢指针法 -- 思想，所有语言共有
// 维护一个快慢指针，[0, slow]区间的为不重复元素集合，通过交换元素在原地实现方法
function removeDuplicatesV2(&$nums)
{
    if (empty($nums)) return [];
    $slow = 0;
    $fast = 0;
    $cou = count($nums);
    while ($fast < $cou) {
        if ($nums[$fast] != $nums[$slow]) { // nums是排序好的
            $slow++;
            $nums[$slow] = $nums[$fast];
        }
        $fast++;
    }
    return $slow+1;
}