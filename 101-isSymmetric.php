<?php

/**
 * 给定一个二叉树，检查它是否是镜像对称的。
例如，二叉树 [1,2,2,3,4,4,3] 是对称的。
   1
  /   \
 2      2
/ \    /  \
3  4  4   3
但是下面这个 [1,2,2,null,3,null,3] 则不是镜像对称的:
1
/ \
2   2
 \   \
 3    3
 */
class Solution {

    /**
     * https://mp.weixin.qq.com/s/5voTWHFuB9szmXGcJUzOPQ
     * 对称二叉树
     *
     * 迭代法
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric($root)
    {
        return $this->compare($root->left, $root->right);
    }
    function compare ($left, $right)
    {
        // 首先排除空节点的情况
        if ($left === null && $right === null) {
            return true;
        } elseif ($left !== null && $right === null) {
            return false;
        } elseif ($left === null && $right !== null) {
            return false;
        } elseif ($left->val !== $right->val) {
            // 排除了空节点，再排除数值不相同的情况
            return false;
        }

        // 此时就是：左右节点都不为空，且数值相同的情况
        // 此时才做递归，做下一层的判断
        $inside = $this->compare($left->right, $right->left);
        $outside = $this->compare($left->left, $right->right);
        $isSame = $inside && $outside;
        return $isSame;
    }

    // ------------- 分割线 -------------

    // 迭代法 --- 并非严格的dfs和bfs，只是借助栈或队列来进行比较
    // 核心是 两两匹配
    function isSymmetricV2 ($root)
    {
        if ($root === null) return true;

        $queue = [];
        array_push($queue, $root->left);
        array_push($queue, $root->right);
        while (!empty($queue)) {
            $left = array_pop($queue); // 上面先push left
            $right = array_pop($queue);
            // 相等，继续进行比较
            if ($left === null && $right === null) {
                continue;
            }
            if ( !$left || !$right || ($left->val != $right->val) ) {
                return false;
            }
            
            // 节点都不为空且值相等，继续进行比较
            array_push($queue, $left->left);
            array_push($queue, $right->right);
            array_push($queue, $left->right);
            array_push($queue, $right->left);
        }
        return true;
    }

}