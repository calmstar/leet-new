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

}