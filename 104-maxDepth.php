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

    // bfs
    function maxDepthV3 ($root)
    {
        $deep = 0;
        if ($root === null) return $deep;
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $deep++;
            $num = count($queue);
            while ($num > 0) {
                $tmp = array_shift($queue);

                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
        }
        return $deep;
    }

    //  ---------- 分割线 -----------

    // dfs
    // 无论是 前序遍历 还是用 后序遍历，求深度只需要一趟扫描就行了，可选择"递"或"归"任意一趟
    private $max = 0;
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxDepth($root)
    {
        // 到底部就停止计算，直接返回 $max 。重点在"递"这步，"归"直接返回
        if ($root === null) return 0;
        $this->getMax($root, 1);
        return $this->max;
    }
    function getMax ($root, $deep)
    {
        if ($root === null) return;
        $this->max = max($this->max, $deep);
        $this->getMax($root->left, $deep+1);
        $this->getMax($root->right, $deep+1);
    }

    // ---------- 分割线 -----------

    /**
     * 后序遍历，求高度
     * @param $root
     * @return int|mixed
     */
    function maxDepthV1 ($root)
    {
        if ($root === null) return 0;
        $leftMax = $this->maxDepth($root->left);
        $rightMax = $this->maxDepth($root->right);
        // 后序遍历，从 底部向高处 进行计算，得到高度
        // 执行过程在 "归" 这一步，所以重点看return值怎么累加
        return max($leftMax, $rightMax) + 1;
    }
}