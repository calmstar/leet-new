<?php
require_once 'tools.php';
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
     * https://leetcode-cn.com/problems/cong-shang-dao-xia-da-yin-er-cha-shu-lcof/
     * 实际上就是广度优先搜索： BFS
     * @param TreeNode $root
     * @return Integer[]
     */
    function levelOrder($root)
    {
        if (empty($root)) return [];
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $node = array_shift($queue);
            if ($node->left) {
                array_push($queue, $node->left);
            }
            if ($node->right) {
                array_push($queue, $node->right);
            }
            $res[] = $node->val;
        }
        return $res;
    }

}
$a = [3,9,20,null,null,15,7];
$tree = buildTree($a);
$res = (new Solution())->levelOrder($tree);
var_dump($res);
