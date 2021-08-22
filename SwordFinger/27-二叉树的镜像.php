<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function mirrorTree($root)
    {
        if ($root === null) return $root;
        $temp = $root->left;
        $root->left = $this->mirrorTree($root->right);
        $root->right = $this->mirrorTree($temp);
        return $root;
    }
}






