<?php

class Solution {

    /**
     * 二叉搜索树中的搜索
     *
     * @param TreeNode $root
     * @param Integer $val
     * @return TreeNode
     */
    function searchBST($root, $val)
    {
        $res = null;
        if ($root->val == $val) {
            return $root;
        } elseif ($root->val > $val) {
            // 不让空节点进入递归逻辑 & 利用二叉搜索树左小右大的特点
            $root->left && $res = $this->searchBST($root->left, $val);
        } else {
            $root->right && $res = $this->searchBST($root->right, $val);
        }
        return $res;
    }

    // 简洁写法
    function searchBSTV2 ($root, $val)
    {
        if ($root == null || $root->val == $val) return $root;
        if ($root->val > $val) {
            // 直接return结果，因为就只有一条路径的结果，结果要么为null要么为某个节点
            return $this->searchBSTV2($root->left, $val);
        }
        if ($root->val < $val) {
            return $this->searchBSTV2($root->right, $val);
        }
        return null;
    }

    // ----------------- 分割线 -----------------
    // 类似二分查找，利用特性进行指针偏移。
    // 不需要像普通二叉树一样  利用栈或队列特性 进行 深度广度遍历，
    function searchBSTV3 ($root, $val)
    {
        while ($root !== null) {
            if ($root->val == $val) {
                return $root;
            } elseif ($root->val > $val) {
                $root = $root->left;
            } else {
                $root = $root->right;
            }
        }
        return null;
    }

}