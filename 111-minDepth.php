<?php
/**
 * 二叉树的最小深度
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
     * 递归解法 -- 后序遍历 -- 计算高度值，在"归"过程计算判断，保存所需值
     * @param TreeNode $root
     * @return Integer
     */
    function minDepth($root) {
        if ($root === null) return 0;
        $left = $this->minDepth($root->left);
        $right = $this->minDepth($root->right);
        // 如果有一个最小值为0，说明树是倾斜一方的，应该取最大值的那个（因为最小的深度指的叶子节点，是都没有左右儿子节点的）
        if (min($left, $right) == 0) {
            return max($left, $right) + 1;
        } else {
            return min($left, $right) + 1;
        }
    }

    // 深度遍历 -- 前序遍历 -- 计算深度，在"递"的过程进行计算判断保存值，"归"过程放
    private $res = null;
    function minDepthV2 ($root)
    {
        if ($root === null) return 0;
        $this->getMin($root, 1);
        return $this->res;
    }
    function getMin ($root, $deep)
    {
        if ($root === null) return;
        if ($root->left === null && $root->right === null) { // 当左右子树都为空的时候，才是到了叶子节点
            if ($this->res !== null) {
                $this->res = min($this->res, $deep); // 取到达叶子节点最小的深度值
            } else {
                $this->res = $deep; // 初始化状态，不需要比较
            }
        }
        $this->getMin($root->left, $deep+1);
        $this->getMin($root->right, $deep+1);
    }

    // 通过栈进行解决，-- 深度优先遍历 -- 搞不了
    function minDepthDFS ($root)
    {

    }

    // 通过队列进行解决 -- 广度优先遍历
    function minDepthBFS ($root)
    {
        if (empty($root)) return 0;
        $queue = [];
        array_push($queue, $root);
        $num = 1;
        while (!empty($queue)) {
            // 将该队列的所有元素都取出来 -- 即每次取完这一层所有元素
            $size = count($queue);
            for ($i = 0; $i < $size; $i++) {
                $curr = array_shift($queue);
                if (empty($curr->left) && empty($curr->right)) {
                    return $num;
                }
                !empty($curr->left) && array_push($queue, $curr->left); // 将下一层的数据放入queue中
                !empty($curr->right) && array_push($queue, $curr->right);
            }
            // 这一层的所有元素都没有断掉null，则+1
            $num++;
        }
        return $num;
    }


}







