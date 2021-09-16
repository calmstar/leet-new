<?php


class Solution {

    /**
     * 相同的树
     *
     * 给你两棵二叉树的根节点 p 和 q ，编写一个函数来检验这两棵树是否相同。
    如果两个树在结构上相同，并且节点具有相同的值，则认为它们是相同的。

     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */
    function isSameTree($p, $q)
    {
        $queue = [];
        array_push($queue, $p);
        array_push($queue, $q);
        while (!empty($queue)) {
            $tmpP = array_shift($queue);
            $tmpQ = array_shift($queue);
            if ($tmpP && !$tmpQ) return false;
            if (!$tmpP && $tmpQ) return false;
            if (!$tmpP && !$tmpQ) continue;
            if ($tmpP->val != $tmpQ->val) return false;

            // 节点都不为空,且值相等
            // 两两要匹配的进行push
            array_push($queue, $tmpP->left);
            array_push($queue, $tmpQ->left);
            array_push($queue, $tmpP->right);
            array_push($queue, $tmpQ->right);
        }
        return true;
    }

}