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
     *  N 叉树的后序遍历 （左右根）
     *
     * 递归法
     *
     * @param Node $root
     * @return integer[]
     */
    function postorder($root)
    {
        $this->postorderRecursive($root);
        return $this->res;
    }
    private $res = [];
    function postorderRecursive($root)
    {
        if ($root === null) return;
        $this->res[] = $root->val;
        foreach ($root->children as $v) {
            $this->postorderRecursive($v);
        }
    }

    // --------- 分割线 ---------

    // 迭代法 (在 589-preorder 结果顺序 根左右 的基础上，改成 根右左，然后反转变成 左右根)
    function postorderV2($root)
    {
        $res = [];
        if ($root === null) return $res;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            $res[] = $tmp->val;

            $num = count($tmp->children);
            for ($i = 0; $i < $num; $i++) {
                // 类似二叉树迭代法的后序遍历：从左往右的push，出来就是 根右左 顺序，后面返回时用于reverse --> 左右根
                $tmp->children[$i] !== null && array_push($stack, $tmp->children[$i]);
            }
        }
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
}