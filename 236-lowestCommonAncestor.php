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
     * https://mp.weixin.qq.com/s/9RKzBcr3I592spAsuMH45g
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        if ($root === null) return null;
        if ($root === $p || $root===$q) return $root;

        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if ($left === null && $right === null) {
            return null;
        }
        if ($left !== null && $right !== null) { // // 如果p和q都在以root为根的树中，那么left和right一定分别是p和q（从 base case 看出来的）。
            return $root;
        }
        return $left === null ? $right : $left;
    }
}