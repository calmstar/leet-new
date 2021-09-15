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

    private $res = [];
    /**
     * 后续遍历
     * @param TreeNode $root
     * @return Integer[]
     */
    function postorderTraversal($root)
    {
        $this->postorder($root);
        return $this->res;
    }

    function postorder ($root)
    {
        if ($root === null) return;
        $this->postorder($root->left);
        $this->postorder($root->right);
        $this->res[] = $root->val;
    }

    // --------- 迭代法 ---------

    function postorderTraversalV2 ($root)
    {
        $res = [];
        if ($root === null) return $res;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            $res[] = $tmp->val;

            $tmp->left !== null && array_push($stack, $tmp->left); // 将先序遍历的left right顺序反过来，最终结果res变为 根右左
            $tmp->right !== null  && array_push($stack, $tmp->right);
        }
        // res变为 根右左，将数组反转变为 左右根
        $right = count($res)-1;
        $left = 0;
        while ($left <= $right) {
            $tmp = $res[$right];
            $res[$right] = $res[$left];
            $res[$left] = $tmp;
            $left++;
            $right--;
        }
        return $res;
    }


}