<?php

/**
 *
 * 回溯算法 -- 穷举子集（子序列）
 * https://mp.weixin.qq.com/s/qT6WgR6Qwn7ayZkI3AineA
 *
 * 比如输入 nums = [1,2,3]，你的算法应输出 8 个子集，包含空集和本身，顺序可以不同：
[ [],[1],[2],[3],[1,3],[2,3],[1,2],[1,2,3] ]
 */

class Solution {
    // v1 ： 回溯法 -- 通用
    // 子集结果
    private $res = [];
    function subsets ($nums)
    {
        if (empty($nums)) return [];

        $track = [];
        $start = 0;
        $this->backtrack($nums, $start, $track);
        return $this->res;
    }
    function backtrack ($nums, $start, $track)
    {
        // 已经用start处理，所以都符合
        array_push($this->res, $track);
        for ($i = $start; $i < count($nums); $i++) {
            array_push($track, $nums[$i]);
            $this->backtrack($nums, $i+1, $track); // 注意是 $i+1 ,索引递增的
            array_pop($track);
        }
    }


    // ----------- v2 递归方法---------
    function subsetsV2 ($nums)
    {

    }

}
$nums = [1, 2, 3];
$res = (new Solution())->subsets($nums);
print_r($res);
