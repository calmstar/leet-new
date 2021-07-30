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
     * https://mp.weixin.qq.com/s/OlpaDhPDTJlQ5MJ8tsARlA
     * 两个树的都没有重复元素
     * @param Integer[] $preorder
     * @param Integer[] $inorder
     * @return TreeNode
     */
    function buildTree ($preorder, $inorder)
    {
        if (count($preorder) == 0) {
            return null;
        }
        if (count($preorder) == 1) {
            return new TreeNode($preorder[0]);
        }

        $preStart = 0;
        $preEnd = count($preorder)-1;
        $inStart = 0;
        $inEnd = count($inorder)-1;
        return $this->build($preorder, $preStart, $preEnd, $inorder, $inStart, $inEnd);
    }

    function build ($preorder, $preStart, $preEnd, $inorder, $inStart, $inEnd)
    {
        $this->debug($this->deep++, "{$preStart}-{$preEnd}, {$inStart}-{$inEnd}");
        if ($preStart > $preEnd) return null;

        // 前序遍历的第一个值就是根节点; 根节点对应的左右节点需要配合中序遍历来看
        $rootVal = $preorder[0];
        $root = new TreeNode($preorder[$rootVal]);
        // 中序遍历根节点的左边就是左子树，右边就是右子树
        $midIndex = 0;
        for ($i = $inStart; $i <= $inEnd; $i++) {
            if ($inorder[$i] == $rootVal) {
                $midIndex = $i;
                break;
            }
        }
        // 前序遍历数组，就可以根据上面左子树的$leftSize来确定元素
        $leftSize = $midIndex-$inStart;

        $root->left = $this->build($preorder, $preStart+1, $preStart+$leftSize, $inorder, $inStart, $midIndex-1);
        $root->right = $this->build($preorder, $preStart+$leftSize+1, $preEnd, $inorder, $midIndex+1, $inEnd);
        return $root;
    }

    // 递归调试代码
    private $deep = 0;
    function debug ($deep, $str = '')
    {
        $space = '--';
        for ($i = 0; $i < $deep; $i++) {
            $space .= '--';
        }
        echo $space . ': '. $str . PHP_EOL;
    }

}