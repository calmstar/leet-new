<?php

class Solution {

    /**
     * https://mp.weixin.qq.com/s/hmx6JMj7yLrkhcpogBf5hg
     *
     * 二叉搜索树的插入
     * @param TreeNode $root
     * @param Integer $val
     * @return TreeNode
     */
    function insertIntoBST($root, $val)
    {
        // 递归出口，只为了防止一开始传入空树的情况
        if ($root === null) return new TreeNode($val);

        // 单层递归逻辑
        if ($val < $root->val) {
            if ($root->left === null) {
                $root->left = new TreeNode($val);
            } else {
                // 因为实际创建节点 是在当层的判断上创建的，而不是在下层的递归出口处，所以可以不用接收返回参数（地址引用）
//                $root->left = $this->insertIntoBST($root->left, $val);
                $this->insertIntoBST($root->left, $val);
            }
        }
        if ($val > $root->val) {
            if ($root->right === null) {
                $root->right = new TreeNode($val);
            } else {
//                $root->right = $this->insertIntoBST($root->right, $val);
                $this->insertIntoBST($root->right, $val);
            }
        }
        return $root;
    }

    // 整理上面的思路：依据处理的不同，代码逻辑可以接收或不接收参数
    function insertIntoBSTV1($root, $val)
    {
        // 递归出口，将节点创建放在此处
        if ($root === null) return new TreeNode($val);

        // 单层递归逻辑
        if ($val < $root->val) {
            // 因为节点创建放在下一层的递归出口处，所以这里必须接收返回值
            $root->left = $this->insertIntoBSTV1($root->left, $val);
        }
        if ($val > $root->val) {
            $root->right = $this->insertIntoBSTV1($root->right, $val);
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