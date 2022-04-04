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
     * 二叉树 的最近公共祖先 ，236是 p q 节点一定存在，本道题 pq 节点不一定存在
     *
     * https://mp.weixin.qq.com/s/njl6nuid0aalZdH5tuDpqQ
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q)
    {
        $res = $this->find($root, $p, $q);
        if ($this->foundP && $this->foundQ) {
            return $res;
        } else {
            return null;
        }
    }

    private $foundP = false;
    private $foundQ = false;

    function find ($root, $p, $q)
    {
        if ($root === null) return null;
        $left = $this->find($root->left, $p, $q);
        $right = $this->find($root->right, $p, $q);

        if ($root == $p || $root == $q) {
            // 找到了 记录下
            if ($root == $p) $this->foundP = true;
            if ($root == $q) $this->foundQ = true;
            return $root;
        }

        // 后序位置
        if ($left !== null && $right !== null) {
            return $root;
        }
        if ($left === null && $right === null) {
            return null;
        }
        return $left === null ? $right : $left;

    }

}