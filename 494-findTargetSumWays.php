<?php
class Solution {

    /**
     * 利用回溯法，暴力求解
     *
     * [1,1,1,1,1] 3
     * 状态，选择（+-）
     * @param $nums
     * @param $target
     * @return int
     */
    function findTargetSumWays ($nums, $target): int
    {
        if (count($nums) == 0) return 0;
        $this->backtrack($nums, $target, 0, 0);
        return $this->res;
    }
    private $res = 0;
    function backtrack ($nums, $target, $i, $sum)
    {
        if ($i == count($nums)) { // 当 大于最大索引i时，说明遍历完了
            if ($sum == $target) {
                $this->res++;
            }
            return;
        }
        foreach (['+', '-'] as $v) {
            // 做选择
            if ($v == '+') {
                $sum += $nums[$i];
            } else {
                $sum -= $nums[$i];
            }
            // 穷举所有选择
            $newIndex = $i + 1;
            $this->backtrack($nums, $target, $newIndex, $sum);
            // 撤销选择
            if ($v == '-') {
                $sum += $nums[$i];
            } else {
                $sum -= $nums[$i];
            }
        }
    }

    // -------- 动态规划 --------
    /**
     * 利用动态规划
     *  https://mp.weixin.qq.com/s/OyqQXQnyH_UzmxdytK2rTA
     *  很迷，不懂
     * [1,1,1,1,1] 3
     * 状态，选择（+-）
     * @param $nums
     * @param $target
     * @return int
     */
    function findTargetSumWaysV2 ($nums, $target): int
    {
        if (count($nums) == 0) return 0;
        return $this->dp($nums, 0, $target);
    }
    private $memo = [];
    function dp ($nums, $i, $rest)
    {
        if ($i == count($nums)) {
            if ($rest == 0) return 1; // 结果符合，+1
            return 0;
        }
        $key = $i . ',' . $rest; // 备忘录的key
        if (isset($this->memo[$key])) return $this->memo[$key];
        // 选择+号或者-号
        $res = $this->dp($nums, $i+1, $rest-$nums[$i]) + $this->dp($nums, $i+1, $rest+$nums[$i]);
        $this->memo[$key] = $res;
        return $res;
    }

}
$nums = [1,1,1,1,1];
$target = 3;
$res = (new Solution())->findTargetSumWaysV2($nums, $target);
var_dump($res);