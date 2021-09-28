<?php

class Solution {

    /**
     * 修剪二叉搜索树
     *
     * https://mp.weixin.qq.com/s/nRbCcxMsn0lhtHzkaNIH2w
     * @param TreeNode $root
     * @param Integer $low
     * @param Integer $high
     * @return TreeNode
     */
    function trimBST($root, $low, $high)
    {
        if ($root == null) return null;

        if ($root->val < $low) {
            // 往右子树
            //  寻找符合区间[low, high]的节点
            return $this->trimBST($root->right, $low, $high);
        }
        if ($root->val > $high) {
            // 往左子树
            //  寻找符合区间[low, high]的节点
            return $this->trimBST($root->left, $low, $high);
        }

        $root->left = $this->trimBST($root->left, $low, $high);
        $root->right = $this->trimBST($root->right, $low, $high);
        return $root;
    }
}