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
 *
 *
  4
/   \
2     7
/ \   / \
1   3 6   9
 *
 *
  4
/   \
7     2
/ \   / \
9   6 3   1
 *
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root)
    {
        if ($root === null) return $root;
        /**
         *     4
             /   \
            7     2
         * left和right只是root节点4的两个属性--指针，分别指向值为7，和值为2的地址。
         * 下面的👇 $temp 只是暂存值为2的地址。
         */
        $temp = $root->right;
        $root->right = $this->invertTree($root->left);
        $root->left = $this->invertTree($temp);
        return $root;
    }

    function invertTreeV2 ($root)
    {
        if ($root == null) return null;

        // 交换节点指针指向,使得属性左右指针互换
        $temp = $root->right;
        $root->right = $root->left;
        $root->left = $temp;

        $this->invertTreeV2($root->left);
        $this->invertTreeV2($root->right);
        return $root;
    }

}