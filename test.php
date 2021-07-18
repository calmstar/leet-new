<?php
function intersection($nums1, $nums2) {
    return array_values(array_unique(array_intersect($nums1, $nums2)));
}

$res = intersection([1,2,2,1], [2,2,1]);
var_dump($res);