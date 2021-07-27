<?php

/**
 * Definition for a Node.
 * class Node {
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->left = null;
 *         $this->right = null;
 *         $this->next = null;
 *     }
 * }
 */

class Solution {

    /**
     * 连接节点, 注意跨越一级父节点的连接
     *
     * @param Node $root
     * @return Node
     */
    public function connect($root) {
        if ($root === null) return null;
        $this->connectTwoNodes($root->left, $root->right);
        return $root;
    }

    private function connectTwoNodes ($left, $right)
    {
        if ($left === null || $right === null) {
            return null;
        }

        // 连接当前两个节点 -- 前序遍历
        $left->next = $right;

        // 连接当前节点各自的子节点
        $this->connectTwoNodes($left->left, $left->right);
        $this->connectTwoNodes($right->left, $right->right);

        // 跨节点进行连接
        $this->connectTwoNodes($left->right, $right->left);
    }

}