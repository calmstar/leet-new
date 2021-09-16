<?php


class Solution {

    /**
     * 另一棵树的子树
     * 跟 100 题联系起来
     *
     * @param TreeNode $root
     * @param TreeNode $subRoot
     * @return Boolean
     */
    function isSubtree($root, $subRoot)
    {
        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            $tmp = array_shift($queue);
            if ($tmp->val == $subRoot->val) {
                $res = $this->isSameTree($tmp, $subRoot);
                if ($res) return true;
            }

            $tmp->left && array_push($queue, $tmp->left);
            $tmp->right && array_push($queue, $tmp->right);
        }
        return false;
    }

    // 判断两棵树是否相等 -- 100-isSameTree
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