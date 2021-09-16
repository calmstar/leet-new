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
     * N 叉树的前序遍历: 根左右 (迭代法和递归法都可参考二叉树的前序遍历)
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

    // -------------- 分割线 ---------------
    // 迭代法 -- 类似二叉树的前序遍历迭代法
    function preorderV2 ($root)
    {
        $res = [];
        if ($root === null) return $res;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            $res[] = $tmp->val;

            $maxIndex = count($tmp->children) - 1;
            for ($i = $maxIndex; $i >= 0; $i--) {
                // 类似二叉树遍历，先右后左，栈出来的顺序就会先左后右
                $tmp->children[$i] && array_push($stack, $tmp->children[$i]);
            }
        }
        return $res;
    }

}