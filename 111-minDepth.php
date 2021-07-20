<?php
/**
 * 二叉树的最小深度
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

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function minDepth($root) {
        if ($root == null) {
            return 0;
        }
        $leftMin = $this->minDepth($root->left) + 1;
        $rightMin = $this->minDepth($root->right) + 1;
        if ( min($leftMin, $rightMin) == 1 ) {
            if ($leftMin > $rightMin) {
                return $leftMin;
            } else {
                return $rightMin;
            }
        } else {
            return min($leftMin, $rightMin);
        }
    }
}







