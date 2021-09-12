<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/4
 * Time: 12:04
 */

/*
 * 给定一个二叉树，找出其最小深度。

最小深度是从根节点到最近叶子节点的最短路径上的节点数量。

说明: 叶子节点是指没有子节点的节点。

示例:

给定二叉树 [3,9,20,null,null,15,7],

    3
   / \
  9  20
    /  \
   15   7
返回它的最小深度  2.

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/minimum-depth-of-binary-tree
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($value) { $this->val = $value; }
 }

class Solution {

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function minDepth($root) {
        if ($root == null) return 0;
        if ($root->left == null) return $this->minDepth($root->right)+1;
        if ($root->right == null) return $this->minDepth($root->left)+1;
        return min($this->minDepth($root->left), $this->minDepth($root->right)) + 1;
    }


    // 官方广度优先搜索 -- 借助队列
    function minDepthOfficial ($root)
    {
        if ($root == null) return 0;
        if ($root->left == null && $root->right == null) return 1;
        $arr = [];
        $minDepth = 0;
        array_push($arr, $root); // [$root],把第一个节点放进队列中

        while ($cou = count($arr)) { //$cou 代表队列中含有的节点个数
            $minDepth++;

            // 把该层的所有节点拿出来循环
            for ($i = $cou; $i > 0; $i--) {
                $node = array_shift($arr); // 将节点个数依次拿出来

                // 由于层次遍历，所以遇到的第一个节点没有左右子节点，则最小深度就在此， 所以跳出两层循环
                if ($node->left == null && $node->right == null) break 2;

                // 依次把该节点的左右子节点放进 队列中
                $node->left && array_push($arr, $node->left);
                $node->right && array_push($arr, $node->right);
            }
        }
        return $minDepth;
    }

}