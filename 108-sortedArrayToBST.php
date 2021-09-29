<?php

class Solution {

    /**
     * 将有序数组转换为二叉搜索树
     *
     * @param Integer[] $nums
     * @return TreeNode
     */
    function sortedArrayToBST($nums)
    {
        if (empty($nums)) return null;

        // 根操作
        // 每次取数组的中间节点作为当前节点，然后分割左右数组
        $cou = count($nums);
        $midIndex = floor($cou/2);
        $root = new TreeNode($nums[$midIndex]);
        $leftNums = array_slice($nums, 0, $midIndex);
        $rightNums = array_slice($nums, $midIndex+1, $cou-$midIndex-1);

        // 左操作
        $root->left = $this->sortedArrayToBST($leftNums);
        // 右操作
        $root->right = $this->sortedArrayToBST($rightNums);

        return $root;
    }



}