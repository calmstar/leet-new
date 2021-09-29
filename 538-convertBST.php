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
     * 把二叉搜索树转换为累加树
     *
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
        // 题目是先右边
        $this->convertBST($root->right);
        // 反中序遍历，右根左
        $this->sum += $root->val;
        $root->val = $this->sum;
        $this->convertBST($root->left);
    }

    // ------------ 分割线 ---------
    // 二叉搜索树，有序，本质就是按照数组顺序从后往前累加. 不过用数组累加后需要重新构造，所以推荐v1
    function convertBSTV2 ($root)
    {

    }

}