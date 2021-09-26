<?php

class Solution {
    /**
     * 二叉搜索树的最近公共祖先
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

}