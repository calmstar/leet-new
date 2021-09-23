<?php

class Solution {

    /**
     * 从中序与后序遍历序列构造二叉树
     * @param Integer[] $inorder
     * @param Integer[] $postorder
     * @return TreeNode
     */
    function buildTree($inorder, $postorder)
    {
        if (count($postorder) == 0) return null;
        if (count($postorder) == 1) {
            return new TreeNode($postorder[0]);
        }

        $inStart = 0;
        $inEnd = count($inorder) - 1;
        $postStart = 0;
        $postEnd = count($postorder) - 1;
        return $this->build($inorder, $inStart, $inEnd, $postorder, $postStart, $postEnd);
    }

    // 根据后序拿到根节点，然后中序数组中切分找到左右子树数组，再根据左右子树数量切分后序数组
    function build ($inorder, $inStart, $inEnd, $postorder, $postStart, $postEnd)
    {
        if ($postStart > $postEnd) return null;

        // 后序遍历的最后一个元素就是root节点
        $rootVal = $postorder[$postEnd];
        $root = new TreeNode($rootVal);

        // 切分数组，先中序，然后后序
        $midIndex = 0;
        for ($i = $inStart; $i <= $inEnd; $i++) {
            if ($inorder[$i] == $rootVal) {
                $midIndex = $i;
                break;
            }
        }

        $leftSize = $midIndex - $inStart;
        $root->left = $this->build($inorder, $inStart, $midIndex-1,
            $postorder, $postStart, $postStart+$leftSize-1); // 注意这里跟105题不同，需要-1

        $root->right = $this->build($inorder, $midIndex+1, $inEnd,
            $postorder, $postStart+$leftSize, $postEnd-1);

        return $root;
    }

}