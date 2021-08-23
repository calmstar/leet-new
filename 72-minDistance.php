<?php
class Solution {

    /**
     * @param String $word1
     * @param String $word2
     * @return Integer
     */
    function minDistance($word1, $word2)
    {
        return $this->dp($word1, strlen($word1)-1, strlen($word2)-1, $word2);
    }

    private $memo = [];
    /**
     * @param $word1 string 目标单词
     * @param $i int 目标单词索引
     * @param $j int 原有单词索引
     * @param $word2 string 原有单词
     * @return int|mixed
     */
    function dp ($word1, $i, $j, $word2)
    {
        if (isset($this->memo[$i][$j])) {
            return $this->memo[$i][$j];
        }
        // baseCase，任意一个单词走完了，剩下的要么进行 全部删除 或 全部添加
        if ($i == -1) return $j+1;
        if ($j == -1) return $i+1;

        if ($word1[$i] == $word2[$j]) {
            // 相等情况，都跳过
            $this->memo[$i][$j] = $this->dp($word1, $i-1, $j-1, $word2);
            return $this->memo[$i][$j];
        } else {
            $this->memo[$i][$j] =  min(
                $this->dp($word1, $i, $j-1, $word2)+1, //插入
                $this->dp($word1, $i-1, $j, $word2)+1, //删除
                $this->dp($word1, $i-1, $j-1, $word2)+1 //替换
            );
            return $this->memo[$i][$j];
        }
    }
}