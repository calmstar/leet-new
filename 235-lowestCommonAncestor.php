<?php

class Solution {
    /**
     * 二叉 搜索树 的最近公共祖先
     *
     * 递归法
     * https://mp.weixin.qq.com/s/97dKWMVEyPH94-3LLaukbA
     *
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q)
    {
        if ($root === null) return $root;

        // 根。 在范围内的 前序遍历 第一个节点就是
        if ( ($root->val <= $q->val && $root->val >= $p->val) || ($root->val <= $p->val && $root->val >= $q->val) ) {
            return $root;
        }
        // 左
        $res1 = $this->lowestCommonAncestor($root->left, $p, $q);
        if ($res1) return $res1; // 找到符合的，直接返回，相当于遍历得到一条路径；非遍历整棵树
        // 右
        $res2 = $this->lowestCommonAncestor($root->right, $p, $q);
        if ($res2) return $res2;
        return null;
    }

    // --------------------- 分割线 --------------------

    function lowestCommonAncestorV2($root, $p, $q)
    {
        if ($root === null) return $root;

        // v2优化搜索范围
        // 左区间
        if ( $root->val > $q->val && $root->val > $p->val) {
            // 左
            $res1 = $this->lowestCommonAncestorV2($root->left, $p, $q);
            if ($res1) return $res1; // 找到符合的，直接返回，相当于遍历得到一条路径；非遍历整棵树
        }
        // 右区间
        if ( $root->val < $q->val && $root->val < $p->val) {
            // 右
            $res2 = $this->lowestCommonAncestorV2($root->right, $p, $q);
            if ($res2) return $res2;
        }

        // 剩下的root->val就是在要求范围内的
        return $root;
    }

    // --------------------- 分割线 --------------------

    // 不需要像普通的树那样，借助栈或队列进行迭代，此处二叉搜索树本身有序就是一个方向了
    function lowestCommonAncestorV3 ($root, $p, $q)
    {
        if ($root === null) return null;

        while ($root) {
            if ($root->val > $p->val && $root->val > $q->val) {
                // 目前在左子树
                $root = $root->left;
            } elseif ($root->val < $p->val && $root->val < $q->val) {
                // 目前在右子树
                $root = $root->right;
            } else {
                // 在 p q的区间内
                return $root;
            }
        }
        return null;
    }
}