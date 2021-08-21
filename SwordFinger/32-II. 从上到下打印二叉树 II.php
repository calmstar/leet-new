<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {

    /**
     * https://leetcode-cn.com/problems/cong-shang-dao-xia-da-yin-er-cha-shu-ii-lcof/
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root) {
        if (empty($root)) return [];
        $res = [];
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            // 把一层的都遍历取出来
            $tmpRes = [];
            $cou = count($queue);
            for ($i = 0; $i < $cou; $i++) {
                $node = array_shift($queue);
                $tmpRes[] = $node->val;
                if ($node->left) {
                    array_push($queue, $node->left);
                }
                if ($node->right) {
                    array_push($queue, $node->right);
                }
            }
            $res[] = $tmpRes;
        }
        return $res;
    }
}
