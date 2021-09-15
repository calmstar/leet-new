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
     * 二叉树的层平均值
     * 本题就是层序遍历的时候把一层求个总和在取一个均值。
     * @param TreeNode $root
     * @return Float[]
     */
    function averageOfLevels($root)
    {
        $res = [];
        if ($root === null) return $res;
        $queue = [];
        array_push($queue, $root); // 队尾进入
        while (!empty($queue)) {
            $num = count($queue);
            $sum = 0;
            $tmpNum = $num;
            while ($num > 0) {
                $tmp = array_shift($queue); // 队头出
                $sum += $tmp->val; // 得到总值

                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
            $res[] = $sum / $tmpNum;
        }
        return $res;
    }
}