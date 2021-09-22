<?php

class Solution {

    /**
     * 路径总和
     * @param TreeNode $root
     * @param Integer $targetSum
     * @return Boolean
     */
    function hasPathSum($root, $targetSum)
    {
        if ($root === null) return false;

        if ($root->left === null && $root->right === null) {
            $this->pathSum += $root->val;
            return $this->pathSum == $targetSum;
        }

        $this->pathSum += $root->val;
//        if ($this->pathSum > $targetSum) return false; // 可能存在负数

        if ($root->left) {
            $resLeft = $this->hasPathSum($root->left, $targetSum);
            $this->pathSum -= $root->left->val; // 全局变量 回溯
            if ($resLeft) {
                return true;
            }
        }
        if ($root->right) {
            $resRight = $this->hasPathSum($root->right, $targetSum);
            $this->pathSum -= $root->right->val; // 回溯
            if ($resRight) {
                return true;
            }
        }
        return false;
    }
    private $pathSum = 0;
}