<?php

class Solution {

    /**
     * 二叉搜索树的最小绝对差
     * 思路：
     *      利用中序遍历，将数字从小到大排列，再计算绝对值，取出绝对值最小的
     * @param TreeNode $root
     * @return Integer
     */
    function getMinimumDifference($root)
    {
        $root->left && $this->getMinimumDifference($root->left);
        if (isset($this->preNum)) $this->min = min($this->min, abs($root->val - $this->preNum));
        $this->preNum = $root->val;
        $root->right && $this->getMinimumDifference($root->right);
        return $this->min;
    }
    private $min = PHP_INT_MAX;
    private $preNum = null;

}