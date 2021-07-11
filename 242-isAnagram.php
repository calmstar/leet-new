<?php

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t) {
        $sLen = strlen($s);
        $tLen = strlen($t);
        if ($sLen != $tLen) {
            return false;
        }

        $map = [];
        for ($i = 0; $i < $sLen; $i++) {
            $ss = $s[$i];
            $tt = $t[$i];

            if ( isset($map[$ss]) ) {
                $map[$ss] = $map[$ss] + 1;
            } else {
                $map[$ss] = 1;
            }

            if ( isset($map[$tt]) ) {
                $map[$tt] = $map[$tt] - 1;
            } else {
                $map[$tt] = -1;
            }
        }
        foreach ($map as $v) {
            if ($v != 0) {
                return false;
            }
        }
        return true;
    }
}