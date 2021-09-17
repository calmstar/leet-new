<?php
/**
 * Definition for a Node.
 * class Node {
 *     public $val = null;
 *     public $children = null;
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->children = array();
 *     }
 * }
 */

class Solution {
    /**
     * 类似 104题 二叉树的最大深度
     *
     * n叉树的最大深度
     * 层序遍历 -- bfs
     *
     * @param Node $root
     * @return integer
     */
    function maxDepth($root)
    {
        $depth = 0;
        if ($root === null) return $depth;
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $depth++;
            $num = count($queue);
            while ($num > 0) {
                $tmp = array_shift($queue);
                foreach ($tmp->children as $v) {
                    $v && array_push($queue, $v);
                }
                $num--;
            }
        }
        return $depth;
    }

    // ------ 分割线 --------

    // 后序遍历, 结合n叉树的递归遍历思考（589，590）
    function maxDepthV2 ($root)
    {
        $depth = 0;
        if ($root === null) return $depth;
        foreach ($root->children as $v) {
            $depth = max($this->maxDepthV2($v), $depth);
        }
        return $depth + 1;
    }

}