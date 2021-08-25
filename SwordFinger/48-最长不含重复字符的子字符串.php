<?php
class Solution {

    /**
     * 滑动窗口
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s)
    {
        $len = strlen($s);
        if(empty($len)) return 0;
        if($len == 1) return 1;
        $left = 0;
        $right = 0;
        $window = []; // 代表窗口中容纳的字符,哈希数组，缓存标示窗口中存在的字符
        $res = 0;
        while ($right < $len) {
            $rStr = $s[$right];
            $right++;
            $window[$rStr]++;

            // 收缩左边。大于1则表示新进来的字符在窗口中已经存在，需要收缩
            while ($window[$rStr] > 1) {
                $lStr = $s[$left];
                $left++;
                $window[$lStr]--;
            }
            $res = max($res, $right-$left);
        }
        return $res;
    }
}