<?php

class Solution {

    /**
     * 二叉搜索树的插入
     * @param TreeNode $root
     * @param Integer $val
     * @return TreeNode
     */
    function insertIntoBST($root, $val)
    {
        if ($root === null) return new TreeNode($val);

        // 单层递归逻辑
        if ($val < $root->val) {
            if ($root->left === null) {
                $root->left = new TreeNode($val);
            } else {
                $root->left = $this->insertIntoBST($root->left, $val);
//                $this->insertIntoBST($root->left, $val); // 因为是地址引用，所以接收不接收都可以
            }
        }
        if ($val > $root->val) {
            if ($root->right === null) {
                $root->right = new TreeNode($val);
            } else {
                $root->right = $this->insertIntoBST($root->right, $val);
//                $this->insertIntoBST($root->right, $val);
            }
        }
        return $root;
    }

    // ----------------- 分割线 --------------------

    // 迭代法，二叉排序树，天然有序，不需要借助栈或队列
    function insertIntoBSTV2 ($root, $val)
    {
        if ($root === null) return new TreeNode($val);
        $head = $root;
        while ($root !== null) {
            if ($val < $root->val) {
                // 左边
                if ($root->left === null) {
                    $root->left = new TreeNode($val);
                    break;
                } else {
                    $root = $root->left;
                }
            } else {
                // 右边，参数保证是不相等的
                if ($root->right === null) {
                    $root->right = new TreeNode($val);
                    break;
                } else {
                    $root = $root->right;
                }
            }
        }
        return $head;
    }

}