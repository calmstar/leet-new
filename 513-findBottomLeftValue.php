<?php

class Solution {
    /**
     * 找树左下角的值
     *
     * 给定一个二叉树的 根节点 root，请找出该二叉树的 最底层 最左边 节点的值。
    假设二叉树中至少有一个节点。
     */

    /**
     * 层序遍历法
     * @param TreeNode $root
     * @return Integer
     */
    function findBottomLeftValue($root)
    {
        $queue = [];
        array_push($queue, $root);
        $value = null;
        while (!empty($queue)) {
            $num = count($queue);
            $value = $queue[0]->val;
            while ($num) {
                $tmp = array_shift($queue);

                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
        }
        return $value;
    }
}