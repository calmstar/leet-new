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
     * @param TreeNode $A
     * @param TreeNode $B
     * @return Boolean
     */
    function isSubStructure($A, $B)
    {
        if (empty($A) || empty($B)) return false;
        $subVal = $B->val;
        // 注意返回值类型
        return $this->getRoot($A, $subVal, $B);
    }

    // 找到第一个相等的节点，然后进行比较
    function getRoot ($A, $subVal, $B)
    {
        if ($A === null) return false;
        if ($A->val === $subVal) {
            $res = $this->judge($A, $B);
            if ($res) return $res; // true才返回。如果是false就不返回，继续寻找下一个可能
        }
        return $this->getRoot($A->left, $subVal, $B) ||
        $this->getRoot($A->right, $subVal, $B);

    }

    // 对这个节点进行递归比较和判断
    function judge ($root, $subRoot)
    {
        if ($root->val !== $subRoot->val) {
            return false;
        }
        $res1 = true; // 给予默认值，不然下面return有问题
        $res2 = true;
        if ($subRoot->left !== null) {
            $res1 = $this->judge($root->left, $subRoot->left);
        }
        if ($subRoot->right !== null) {
            $res2 = $this->judge($root->right, $subRoot->right);
        }
        return $res1 && $res2;
    }

}