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
     * 后续遍历
     * @param TreeNode $root
     * @return Integer[]
     */
    function postorderTraversal($root)
    {
        $this->postorder($root);
        return $this->res;
    }

    function postorder ($root)
    {
        if ($root === null) return;
        $this->postorder($root->left);
        $this->postorder($root->right);
        $this->res[] = $root->val;
    }


}