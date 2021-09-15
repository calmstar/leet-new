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
     * 二叉树的右视图
     * 给定一棵二叉树，想象自己站在它的右侧，按照从顶部到底部的顺序，返回从右侧所能看到的节点值。
     *
     * 思路：
     *      层序遍历的时候，判断是否遍历到单层的最后面的元素，如果是，就放进result数组中，随后返回result就可以了。
     * @param TreeNode $root
     * @return Integer[]
     */
    function rightSideView($root)
    {
        $res = [];
        if ($root === null) return $res;
        $queue = [];
        array_push($queue, $root); // 队尾进入
        while (!empty($queue)) {
            $num = count($queue);
            while ($num > 0) {
                $tmp = array_shift($queue); // 队头出
                if ($num == 1) $res[] = $tmp->val;
                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
        }
        return $res;
    }
}