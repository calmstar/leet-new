<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/ZhPEchewfc03xWv9VP3msg
     * 两个字符串的最小ASCII删除和
     *
     * @param String $s1
     * @param String $s2
     * @return Integer
     */
    function minimumDeleteSum($s1, $s2)
    {
        return $this->dp($s1, $s2, 0, 0);
    }

    private $memo = [];
    // 将 s1[i...] s2[j...] 删除成相同的字符长，最小的ascii的码值为 dp[$i][$j]
    function dp ($s1, $s2, $index1, $index2)
    {
        // baseCase
        $value = 0;
        // 走完了，都不用删除，直接返回0
        if (!isset($s1[$index1]) && !isset($s2[$index2])) {
            return 0;
        }
        // 如果 s1走完了，s2的都要删除
        if (!isset($s1[$index1]) && isset($s2[$index2])) {
            for ($i = $index2; $i < strlen($s2); $i++) {
                $value += ord($s2[$i]);
            }
            return $value;
        }
        // 如果 s2走完了，s1的都要删除
        if (!isset($s2[$index2]) && isset($s1[$index1])) {
            for ($j = $index1; $j < strlen($s1); $j++) {
                $value += ord($s1[$j]);
            }
            return $value;
        }
        if (isset($this->memo[$index1][$index2])) {
            return $this->memo[$index1][$index2];
        }

        if ($s1[$index1] == $s2[$index2]) {
            // 相等，不用删除
            $this->memo[$index1][$index2] = $this->dp($s1, $s2, $index1+1, $index2+1);
        } else {
            // 不相等，需要删除
            $this->memo[$index1][$index2] = min(
                $this->dp($s1, $s2, $index1, $index2+1) + ord($s2[$index2]), // 删除 $s2[$index2] 字符
                $this->dp($s1, $s2, $index1+1, $index2) + ord($s1[$index1]) // 删除 $s1[$index1] 字符
            );
        }
        return $this->memo[$index1][$index2];
    }

}