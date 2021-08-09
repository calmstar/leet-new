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

    /**
     * 后序遍历
     * 时间复杂度：每次O(1) * n轮 = O(n) n指的是树节点数量
     * 空间复杂度：O(n) -- 递归空间
     *
     * @param TreeNode $root
     * @return Integer
     */
    function countNodes($root)
    {
        if ($root === null) return 0;
        $l = $this->countNodes($root->left);
        $r = $this->countNodes($root->right);
        return $l + $r + 1;
    }

    // 先序遍历
    private $count = 0;
    function countNodesPre ($root)
    {
        if ($root === null) return 0;
        $this->count++;
        $this->countNodes($root->left);
        $this->countNodes($root->right);
        return $this->count;
    }

    // 利用特性进行 : https://mp.weixin.qq.com/s/xW2fbE3v4JhMSKfxoxIHBg lgN * lgN
    function countNodeSpecial ($root)
    {
        if ($root === null) return 0;
        // 完全二叉树中，左右子树一定有一棵是满二叉树
        $l = 0;
        $r = 0;
        $lCurr = $root;
        $rCurr = $root;
        while ($lCurr !== null) {
            $l++;
            $lCurr = $lCurr->left;
        }
        while ($rCurr !== null) {
            $r++;
            $rCurr = $rCurr->right;
        }
        if ($l === $r) {
            // 利用满二叉树特性进行计算
            return pow(2, $l) - 1;
        }
        return 1 + $this->countNodeSpecial($root->left) + $this->countNodeSpecial($root->right);
    }

}