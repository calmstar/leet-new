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
     * 107 从底向上进行层序遍历
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrderBottom($root) {
        // 在102的基础上，进行反转数组
        $res = $this->levelOrder($root);
        if (empty($res)) return $res;
        return $this->reverse($res);
    }

    function reverse ($arr)
    {
        $left = 0;
        $right = count($arr) - 1;
        while ($left <= $right) {
            $tmp = $arr[$left];
            $arr[$left] = $arr[$right];
            $arr[$right] = $tmp;
            $left++;
            $right--;
        }
        return $arr;
    }

    /**
     * 层序遍历
     * @param $root
     * @return array
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