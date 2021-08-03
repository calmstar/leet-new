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

    private $sum = 0;
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function convertBST($root)
    {
        if ($root === null) return null;
        $this->convert($root);
        return $root;
    }

    function convert ($root)
    {
        if ($root === null) return null;
        $this->convertBST($root->right);
        $this->sum += $root->val;
        $root->val = $this->sum;
        $this->convertBST($root->left);
    }

}