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

    private $res = [];
    /**
     * N 叉树的前序遍历: 根左右
     * https://mp.weixin.qq.com/s/JWmTeC7aKbBfGx4TY6uwuQ
     *
     * 递归法
     * @param Node $root
     * @return integer[]
     */
    function preorder($root)
    {
        $this->preorderRecursive($root);
        return $this->res;
    }
    function preorderRecursive ($root)
    {
        if ($root === null) return;
        $this->res[] = $root->val;
        foreach ($root->children as $v) {
            $this->preorderRecursive($v);
        }
    }

    // 迭代法
}