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

/**
 * 给你一个二叉树，请你返回其按 层序遍历 得到的节点值。 （即逐层地，从左到右访问所有节点）。
示例：
二叉树：[3,9,20,null,null,15,7],

3
/ \
9  20
    /  \
    15   7
返回其层序遍历结果：

[
[3],
[9,20],
[15,7]
]

 */
class Solution {

    /**
     * 层序遍历，需要区分每一层
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root)
    {
        if ($root === null) return [];
        $queue = [];
        $res = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $num = count($queue); // 先计算出本层有多少个元素，按量pop
            $index = count($res);
            while ($num > 0) {
                $tmp = array_shift($queue);

                $tmp->left !== null && array_push($queue, $tmp->left);
                $tmp->right !== null && array_push($queue, $tmp->right);
                $res[$index][] = $tmp->val;
                $num--;
            }
        }
        return $res;
    }

}