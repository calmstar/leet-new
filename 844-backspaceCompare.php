<?php
class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function backspaceCompare($s, $t) {
        $sBack = 0;
        $tBack = 0;
        $sIndex = strlen($s)-1;
        $tIndex = strlen($t)-1;

        while ($sIndex >= 0 || $tIndex >= 0) {
            while ($sIndex >= 0) {
                if ($s[$sIndex] == '#') {
                    $sIndex--;
                    $sBack++;
                } elseif ($sBack > 0) {
                    $sBack--;
                    $sIndex--;
                } else {
                    break;
                }
            }
            while ($tIndex >= 0) {
                if ($t[$tIndex] == '#') {
                    $tIndex--;
                    $tBack++;
                } elseif ($tBack > 0) {
                    $tBack--;
                    $tIndex--;
                }else{
                    break;
                }
            }
            if ($s[$sIndex] == $t[$tIndex]) {
                // 可能负数倒回去又相等了
                if (($sIndex < 0 || $tIndex < 0) && $sIndex != $tIndex) {
                    return false;
                }
                $sIndex--;
                $tIndex--;
            } else {
                return false;
            }
        }
        return true;
    }
}
$a = "aaa###a";
$b = "aaaa###a";
$res = (new Solution())->backspaceCompare($a, $b);
var_dump($res);