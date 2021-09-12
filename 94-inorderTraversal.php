<?php
require_once 'tools.php';
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

    // ------------- 迭代算法 实现中序遍历 ------------
    function inorderTraversalV2($root)
    {
        if ($root === null) return [];
        $res = [];
        $stack = [];
        while (!empty($stack) || $root !== null) {
            if ($root !== null) {
                //不断往左子树方向走，每走一次就将当前节点保存到栈中
                //这是模拟递归的调用
                array_push($stack, $root);
                $root = $root->left;
            } else {
                $tmp = array_pop($stack);
                $res[] = $tmp->val;
                $root = $tmp->right;
            }
        }
        return $res;
    }

    // ------------------------------- 前置知识 -----------------------------

    // 迭代法打印树。思路：递归法用的是系统栈，转变成显示的数据结构栈（可选栈或队列）。
    // 用了显示的数据结构，就可以转变成迭代法。
    // 参考：/Users/starc/code/leet-new/leet-old/DataStructure/Tree.php ； graph-dfs bfs
    // 这里是用栈实现dfs的前序遍历
    function iterationTreePre ($root)
    {
        if ($root === null) return;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            echo $tmp->val . ' ';
            // 放入新的元素
            $tmp->right !== null && array_push($stack, $tmp->right); // 这里是前序遍历。 注意这里是要 right前left后，跟递归的left前不一样
            $tmp->left !== null && array_push($stack, $tmp->left);
        }
    }
    function iterationTreeBFS ($root)
    {
        if ($root === null) return;
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $tmp = array_pop($queue);
            echo $tmp->val . ' ';
            // 放入新的元素
            $tmp->left !== null && array_unshift($queue, $tmp->left); // 这里bfs，先left后right；跟上面前序遍历的 先right后left 不一样。
            $tmp->right !== null && array_unshift($queue, $tmp->right);
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

/**
 * [1,3,2,4,5]结果应该是：
 * bfs：
 *        1 3 2 4 5
 * dfs：
 *      前（根左右）：1 3 4 5 2
 *      中（左根右）：4 3 5 1 2
 *      后（左右根）：4 5 3 2 1
 */
$root = buildTree([1,3,2,4,5]);
(new Solution())->iterationTreePre($root);
echo PHP_EOL;
(new Solution())->iterationTreeBFS($root);