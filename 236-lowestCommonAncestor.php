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
     * https://mp.weixin.qq.com/s/a5cCGw1lY3yTNQoPLr-pGQ
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        // 递归出口，都是针对当前节点的判断，没有使用左右子节点
        if ($root === null) return null;
        if ($root === $p || $root === $q) return $root;

        // 使用left和right接住，处理后进行return，遍历整棵树
        // 左操作
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        // 右操作
        $right = $this->lowestCommonAncestor($root->right, $p, $q);

        // 单层递归逻辑
        // 根操作
        if ($left === null && $right === null) {
            return null;
        }
        if ($left !== null && $right !== null) {
            return $root;
        }
        return $left === null ? $right : $left;
    }

}