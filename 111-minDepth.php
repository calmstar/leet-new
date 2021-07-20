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
     * 递归解法
     * @param TreeNode $root
     * @return Integer
     */
    function minDepth($root) {
        if ($root == null) {
            return 0;
        }
        $leftMin = $this->minDepth($root->left) + 1;
        $rightMin = $this->minDepth($root->right) + 1;
        if ( min($leftMin, $rightMin) == 1 ) {
            if ($leftMin > $rightMin) {
                return $leftMin;
            } else {
                return $rightMin;
            }
        } else {
            return min($leftMin, $rightMin);
        }
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







