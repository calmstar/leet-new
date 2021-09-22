<?php

class Solution {

    /**
     * 迭代法
     * @param TreeNode $root
     * @param Integer $targetSum
     * @return Integer[][]
     */
    function pathSum($root, $targetSum)
    {

    }

    // -------------- 分割线 -------------

    // 在112的基础上，修改逻辑，// 核心，stack里面的元素是一个数组：[ stack, val, [path1, path2] ]
    // 双百
    function pathSumV2 ($root, $targetSum)
    {
        $res = [];
        if ($root === null) return [];
        $stack = [];
        array_push($stack, [$root, $root->val, [$root->val]]);
        while (!empty($stack)) {
            $arr = array_pop($stack);
            $node = $arr[0];
            $val = $arr[1];
            $path = $arr[2];

            if (!$node->left && !$node->right && $targetSum == $val) {
                $res[] = $path;
            }
            if ($node->right) {
                $pathRight = $path; // 防止干扰到下面的$pathRight
                $pathRight[] = $node->right->val;
                array_push($stack, [$node->right, $node->right->val + $val, $pathRight]); // $root->right->val + $val 已经包含了回溯
            }
            if ($node->left) {
                $pathLeft = $path;
                $pathLeft[] = $node->left->val;
                array_push($stack, [$node->left, $node->left->val + $val, $pathLeft]);
            }
        }
        return $res;
    }
}