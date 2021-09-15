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
     * 这道题目说是二叉树，但116题目说是“完美二叉树”（满二叉树），
     * 使用116的迭代法，就其实没有任何差别，一样的代码一样的逻辑。
     * 使用116的递归法就可能有问题。。
     *
     * @param Node $root
     * @return Node
     */
    public function connect($root)
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
}