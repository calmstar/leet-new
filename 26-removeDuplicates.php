<?php

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