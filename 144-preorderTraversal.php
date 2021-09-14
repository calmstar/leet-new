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
}