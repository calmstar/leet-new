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
 *
 * dfs的三种打印方式：实质上，根代表的是打印值的时机
     * 前序遍历（根左右）：4，2，1，3，7，6，9  //4213769
     * 中序遍历（左根右）：1，2，3，4，6，7，9 // 1234679
     * 后序遍历（左右根）：1，3，2，6，9，7，4 //1326974
 *
 *
  4
/   \
2     7
/ \   / \
1  3 6   9
 *
 *
  4
/   \
7     2
/ \   / \
9   6 3   1
 *
 */
class Solution {
    // 层序遍历可以不可以呢？依然可以的！只要把每一个节点的左右孩子翻转一下的遍历方式都是可以的！
    // https://mp.weixin.qq.com/s/jG0MgYR9DoUMYcRRF7magw

    // 迭代法：前序遍历 和 BFS

    // 迭代法：dfs的前序遍历
    function invertTreeV4 ($root)
    {
        if ($root === null) return $root;
        $stack = [];
        array_push($stack, $root);
        while (!empty($stack)) {
            $tmp = array_pop($stack);
            $this->swap($tmp);

            $tmp->right && array_push($stack, $tmp->right);
            $tmp->left && array_push($stack, $tmp->left);
        }
        return $root;
    }

    // BFS
    function invertTreeV3 ($root)
    {
        if ($root === null) return $root;
        $queue = [];
        array_push($queue, $root);

        while (!empty($queue)) {
            $num = count($queue);
            while ($num > 0) {
                $tmp = array_shift($queue);
                $this->swap($tmp);

                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
        }
        return $root;
    }

    // --------------- 分割线 ------------

    // 递归法： 前序 后序遍历
    function invertTreeV2 ($root)
    {
        if ($root == null) return null;

        // 交换节点指针指向,使得属性左右指针互换
        // --- 前序遍历 -- 先交换了再进入下一层递归
        // $this->swap($root);

        $this->invertTreeV2($root->left);
        // --- 中序遍历 -- 不可以，无法解决此问题
        $this->invertTreeV2($root->right);

        // --- 放在后序遍历也可以 -- 先进行"递"到最后"归"的时候，再进行交换
        $this->swap($root);

        return $root;
    }
    function swap ($root)
    {
        $temp = $root->right;
        $root->right = $root->left;
        $root->left = $temp;
    }

    // --------------- 分割线 ---------------
    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root)
    {
        if ($root === null) return $root;
        /**
         *     4
        /   \
        7     2
         * left和right只是root节点4的两个属性--指针，分别指向值为7，和值为2的地址。
         * 下面的👇 $temp 只是暂存值为2的地址。
         */
        $temp = $root->right;
        $root->right = $this->invertTree($root->left);
        $root->left = $this->invertTree($temp);
        return $root;
    }

}