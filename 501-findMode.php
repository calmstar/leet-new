<?php

class Solution {

    /**
     * 二叉搜索树中的众数
     *
     * @param TreeNode $root
     * @return Integer[]
     */
    function findMode($root)
    {
        if ($root == null) return [];
        if (!$root->left && !$root->right) return [$root->val];
        // 获取从小到大的数组
        $this->traversal($root);
        // 处理数组，用了map的方法，其实也可以不用从小到达排序
        return $this->getModeV2($this->arr);
    }

    private $arr = [];
    function traversal ($root)
    {
        if ($root === null) return;
        $this->traversal($root->left);
        $this->arr[] = $root->val;
        $this->traversal($root->right);
    }

     // 用哈希求重复频率最大数字集合，也可以利用数组有序的特性来做，见v2
    function getMode ($arr)
    {
        $hash = []; // [数字，次数]
        $maxNum = 0;
        $cou = count($arr);
        for ($i = 0; $i < $cou; $i++) {
            $num = $arr[$i];
            if (isset($hash[$num])) {
                $hash[$num]++;
            } else {
                $hash[$num] = 1;
            }
            $maxNum = max($maxNum, $hash[$num]);
        }
        $res = [];
        foreach ($hash as $k => $v) {
            if ($v == $maxNum) {
                $res[] = $k;
            }
        }
        return $res;
    }
    function getModeV2 ($arr)
    {
        $cou = count($arr);
        // 最大次数
        $maxCount = 1;
        $tmpCount = 1;
        $res = [$arr[0]];
        for ($i = 1; $i < $cou; $i++) {
            if ($arr[$i] == $arr[$i-1]) {
                $tmpCount++;
            } else {
                // 初始化为1
                $tmpCount = 1;
            }
            // 判断
            if ($tmpCount == $maxCount) {
                $res[] = $arr[$i];
            }
            if ($tmpCount > $maxCount) {
                $res = [];
                $res[] = $arr[$i];
                $maxCount = $tmpCount;
            }
        }
        return $res;
    }

}