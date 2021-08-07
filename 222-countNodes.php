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

    /**
     * 后序遍历
     * 时间复杂度：每次O(1) * n轮 = O(n) n指的是树节点数量
     * 空间复杂度：O(n) -- 递归空间
     *
     * @param TreeNode $root
     * @return Integer
     */
    function countNodes($root)
    {
        if ($root === null) return 0;
        $l = $this->countNodes($root->left);
        $r = $this->countNodes($root->right);
        return $l + $r + 1;
    }

    // 先序遍历
    private $count = 0;
    function countNodesPre ($root)
    {
        if ($root === null) return 0;
        $this->count++;
        $this->countNodes($root->left);
        $this->countNodes($root->right);
        return $this->count;
    }

}