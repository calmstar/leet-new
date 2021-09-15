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
     * 填充每个节点的下一个右侧节点指针
     *
     * 迭代法: 参考程序员carl
     * https://mp.weixin.qq.com/s/4-bDKi7SdwfBGRm9FYduiA
     *
     * @param $root
     * @return mixed
     */
    function connectV3 ($root)
    {
        $res = [];
        if ($root === null) return $res;
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $num = count($queue);
            $pre = null;
            for ($i = 0; $i < $num; $i++) {
                $tmp = array_shift($queue);
                if ($i == 0) {
                    $pre = $tmp;
                } else {
                    $pre->next = $tmp;
                    $pre = $pre->next;
                }
                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
            }
        }
        return $root;
    }

    // -------- 分割线 -----------

    /**
     * 递归法：参考 labuladong
     *
     * 连接节点, 注意跨越一级父节点的连接
     *
     * @param Node $root
     * @return Node
     */
    public function connect ($root) {
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

    // ----- 自己写的 ------
    function connectMy ($root)
    {
        if ($root === null) return null;
        // 前序遍历
        // 连接自己的子节点
        if ($root->left !== null && $root->right !== null) {
            $root->left->next = $root->right;
            // 找到所有跨节点，并连接跨节点
            $this->connectOthers($root->left->right, $root->right->left);
        }
        $this->connectMy($root->left);
        $this->connectMy($root->right);
        return $root;
    }
    // 找到所有跨节点，并连接跨节点
    function connectOthers ($otherLeft, $otherRight)
    {
        if ($otherLeft !== null  && $otherRight !== null) {
            $otherLeft->next =  $otherRight;
            $this->connectOthers($otherLeft->right, $otherRight->left);
        }
    }

}