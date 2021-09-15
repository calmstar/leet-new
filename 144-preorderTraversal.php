<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    private $res = [];
    /**
     * 前序遍历
     * @param TreeNode $root
     * @return Integer[]
     */
    function preorderTraversal($root)
    {
        if ($root === null) return [];
        $this->preorder($root);
        return $this->res;
    }

    function preorder ($root)
    {
        if ($root === null) return;
        $this->res[] = $root->val;
        $this->preorder($root->left);
        $this->preorder($root->right);
    }

    // -------- 迭代法：栈 ----------

    // https://mp.weixin.qq.com/s/OH7aCVJ5-Gi32PkNCoZk4A
    function preorderTraversalV2 ($root)
    {
        $res = [];
        if ($root === null) return $res;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            $res[] = $tmp->val;

            $tmp->right !== null && array_push($stack, $tmp->right); // 先right，后left
            $tmp->left !== null && array_push($stack, $tmp->left);
        }
        return $res;
    }

}