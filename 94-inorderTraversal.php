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

    private $res = [];
    /**
     * 递归算法
     * @param TreeNode $root
     * @return Integer[]
     */
    function inorderTraversal($root)
    {
        $this->inOrder($root);
        return $this->res;
    }

    function inOrder ($root)
    {
        if ($root === null) return;

        $this->inOrder($root->left);
        $this->res[] = $root->val;
        $this->inOrder($root->right);
    }

    // ------------- 迭代算法 ------------
    function inorderTraversalV2($root)
    {

    }

    // -------- 前置知识 -------
    // 迭代法打印树。思路：递归法用的是系统栈，转变成显示的数据结构栈（可选栈或队列）。
    // 用了显示的数据结构，就可以转变成迭代法。
    function iterationTree ($root)
    {
        if (empty($root)) return;
        $stack = [];
        array_push($stack, $root->val);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            echo $tmp->val;

            // 放入新的元素
            array_push($stack, $tmp->left);
            array_push($stack, $tmp->right);
        }
    }
    function inOrderTree ($root)
    {
        if ($root === null) return;
        echo $root->val; // 变换顺序，前中后序遍历；其实就是DFS，用的是系统栈（BFS是用队列）
        $this->inOrder($root->left);
        $this->inOrder($root->right);
    }
    // （数组和链表都可以用迭代递归两种方式遍历）
    function iterationArray ($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            echo $arr[$i];
        }
    }
    function recursiveArray ($arr, $index)
    {
        if (count($arr) >= $index) return;
        echo $arr[$index];
        $this->recursiveArray($arr, $index+1);
    }
    function iterationList ($linkedList)
    {
        while ($linkedList !== null) {
            echo $linkedList->val;
            $linkedList = $linkedList->next;
        }
    }
    function recursiveList ($linkedList)
    {
        if ($linkedList === null) return;
        echo $linkedList->val;
        $this->recursiveList($linkedList->next);
    }

}