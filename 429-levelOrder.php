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
     * N叉树的层序遍历：
     *  给定一个 N 叉树，返回其节点值的层序遍历。(即从左到右，逐层遍历)。
     * 树的序列化输入是用层序遍历，每组子节点都由 null 值分隔（参见示例）。
     *
     * @param Node $root
     * @return integer[][]
     */
    function levelOrder($root)
    {
        $res = [];
        if ($root === null) return $res;
        $queue = [];
        array_push($queue, $root); // 进入队尾

        while (!empty($queue)) {
            $num = count($queue);
            $index = count($res); // 每一层的索引
            while ($num > 0) {
                $tmp = array_shift($queue); // 离开队头
                $res[$index][] = $tmp->val;
                // N叉树
                foreach ($tmp->children as $v) {
                    array_push($queue, $v);
                }
                $num--;
            }
        }
        return $res;
    }

}