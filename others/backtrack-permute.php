<?php

class Solution {
    /**
     * 全排列
     * 比如说输入数组 [1,2,3]，输出结果应该如下，顺序无所谓，不能有重复：

    [
    [1,2,3],
    [1,3,2],
    [2,1,3],
    [2,3,1],
    [3,1,2],
    [3,2,1]
    ]
     *
     * @var array
     */
    private $res = [];
    function permute ($nums)
    {
        $track = [];
        $this->backtrack($nums, $track);
        return $this->res;
    }

    function backtrack ($nums, $track)
    {
        // 判断条件决定树的高度
        if (count($nums) == count($track)) $this->res[] = $track;

        for ($i = 0; $i < count($nums); $i++) { // 循环决定树的宽度
            // 元素不可重复
            if (in_array($nums[$i], $track)) continue;

            // 做选择
            array_push( $track, $nums[$i]);
            // 进入递归树的下一层
            $this->backtrack($nums, $track);
            // 撤销选择
            array_pop($track);
        }
    }
}
$res = (new Solution())->permute([1,2,3]);
var_export($res);