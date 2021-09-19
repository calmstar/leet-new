<?php

class Solution {

    /**
     * 二叉树的所有路径
     *
     * 给你一个二叉树的根节点 root ，按 任意顺序 ，返回所有从根节点到叶子节点的路径。
    叶子节点 是指没有子节点的节点。
     *
     * 定义：输入一个节点，返回以这个节点为根的所有路径
     * 递归出口：当一个节点没有子节点的时候，到达了路径底部
     *      if (!$root->left && !$root->right)
     *          array_push($path, $root->val)
     *          $res[] = $path;
     *          return;
     *
     * 单层递归逻辑：
     *      array_push($path, $root->val)
     *
     *      array_pop($path, $root->val)
     *
     */

    /**
     * @param TreeNode $root
     * @return String[]
     */
    function binaryTreePaths($root)
    {
        if ($root == null) return [];
        $this->backtracking($root, []);
        return $this->res;
    }
    private $res = [];
    function backtracking ($root, $path)
    {
        if (!$root->left && !$root->right) {
            array_push($path, $root->val);
            $this->res[] = $this->translatePath($path);
            return;
        }

        // 前序遍历，根左右
        array_push($path, $root->val);
        if ($root->left !== null) {
            $this->backtracking($root->left, $path);
        }
        if ($root->right !== null) {
            $this->backtracking($root->right, $path);
            // 这里不需要像 46-permute全排列 那样，进行array_pop。
            //  因为全排列，是要在 当前栈中进行下一个数字 的处理；  而本题是要在 下一个栈中进行下一个数字 的处理
            // 或者可以想成：全排列array_push的是当前元素； 本题array_push的是父元素 子元素的处理放在了下一个系统栈中，所以不需要进行array_pop
        }
    }
    function translatePath ($path)
    {
        if (empty($path)) return '';
        $cou = count($path);
        $str = $path[0];
        if ($cou == 1) return $str . ''; // 转成字符串

        // 数组变成箭头
        for ($i = 1; $i < $cou; $i++) {
            $str .= '->' . $path[$i];
        }
        return $str;
    }

    // ---------- v2 也不需要array_pop -----------
    function backtrackingV2 ($root, $path)
    {
        // 前序遍历，根左右
        array_push($path, $root->val);

        if (!$root->left && !$root->right) {
            $this->res[] = $this->translatePath($path);
            return;
        }

        if ($root->left !== null) {
            $this->backtrackingV2($root->left, $path);
        }
        if ($root->right !== null) {
            $this->backtrackingV2($root->right, $path);
        }
    }
}