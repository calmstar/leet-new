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

    function invertTreeV2 ($root)
    {
        if ($root == null) return null;

        // 交换节点指针指向,使得属性左右指针互换
        // --- 前序遍历 -- 先交换了再进入下一层递归
//        $temp = $root->right;
//        $root->right = $root->left;
//        $root->left = $temp;

        $this->invertTreeV2($root->left);

        // --- 中序遍历 -- 不可以，无法解决此问题

        $this->invertTreeV2($root->right);

        // --- 放在后序遍历也可以 -- 先进行"递"到最后"归"的时候，再进行交换
        $temp = $root->right;
        $root->right = $root->left;
        $root->left = $temp;

        return $root;
    }

}