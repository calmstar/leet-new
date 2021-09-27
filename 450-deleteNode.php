<?php

class Solution {

    /**
     * 删除二叉搜索树中的节点
     *     删除后需要调整
     * https://mp.weixin.qq.com/s/X38SPuu9Kw2CPRcB178cEg
     * @param TreeNode $root
     * @param Integer $key
     * @return TreeNode
     */
    function deleteNode($root, $key)
    {
        if ($root === null) return null;

        if ($root->val == $key) {
            // 删除节点没有子节点，直接删除 返回null就可以
            if ($root->left == null && $root->right == null) return null;
            // 删除节点有一个子节点，用子节点直接替换就可以
            if (!$root->left && $root->right) return $root->right;
            if ($root->left && !$root->right) return $root->left;
            // 删除节点有左右子节点，比较复杂，可以看上面的微信文章
            if ($root->left && $root->right) {
                // 右边子节点的最左边：curr
                $curr = $root->right;
                $tmpRight = $curr;
                while ($curr->left) {
                    $curr = $curr->left;
                }
                // curr的左子节点，指向删除节点的左节点
                $curr->left = $root->left;

                return $tmpRight;
            }

        }
        $root->left = $this->deleteNode($root->left, $key);
        $root->right = $this->deleteNode($root->right, $key);
        return $root;
    }




}