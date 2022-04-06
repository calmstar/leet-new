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
     * 二叉树 的最近公共祖先 ，236类似，不过这里是一组节点
     *   https://mp.weixin.qq.com/s/njl6nuid0aalZdH5tuDpqQ
     *
     * 返回参数的思想：https://mp.weixin.qq.com/s/a5cCGw1lY3yTNQoPLr-pGQ
     */
    function lowestCommonAncestor($root, $nodes)
    {
        $valueArr = [];
        foreach ($nodes as $node) {
            $valueArr[] = $node->val;
        }
        return $this->find($root, $valueArr);
    }

    function find ($root, $valueArr)
    {
        if ($root === null) return null;

        if (in_array($root->val, $valueArr)) {
            return $root;
        }
        $left = $this->find($root->left, $valueArr);
        $right = $this->find($root->right, $valueArr);
        if ($left !== null && $right !== null) return $root;
        return $left === null ? $right : $left;
    }

}