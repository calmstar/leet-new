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
        $this->traversal($root);
        return $this->getMode($this->arr);
    }

    private $arr = [];
    function traversal ($root)
    {
        if ($root === null) return;
        $this->traversal($root->left);
        $this->arr[] = $root->val;
        $this->traversal($root->right);
    }

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

}