<?php
require_once 'tools.php';
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {


    // 自己想的第二种写法
    function isSymmetric($root)
    {
        if ($root === null) return true;
        return $this->isEqual($root->left, $root->right); // 可以在本函数返回，也可以在全局变量中返回
    }

    function isEqual ($left, $right)
    {
        // 递归出口
        if ($left === null && $right === null) return true;
        if ($left === null || $right === null) return false; // 其中一个是空的

        // 前序遍历：做点什么
        if ($left->val !== $right->val) {
            return false;
        }
        $res1 = $this->isEqual($left->right, $right->left);
        if (!$res1) return false; // 有一个不等就说明不对称，也没必要往下走了

        $res2 = $this->isEqual($left->left, $right->right);
        if (!$res2) return false;
        return true; // 两个true，返回true
    }


    // ----------- v1 是错误写法 ----------

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetricV1($root)
    {
        $mirrorRoot = $this->mirrorTreeV1($root);
        return $this->judgeV1($root, $mirrorRoot); // 此时Root和mirrorRoot相等，因为root指向的地址对应的内容被反转了。引用传递，地址指向同一个空间
    }

    function judgeV1 ($root, $mirrorRoot)
    {
        if ($root === null && $mirrorRoot === null) return true;
        if ($root === null || $mirrorRoot === null) return false;
        if ($root->val !== $mirrorRoot->val) {
            return false;
        }

        $res1 = $this->judgeV1($root->left, $mirrorRoot->left);
        $res2 = $this->judgeV1($root->right, $mirrorRoot->right);
        return $res1 && $res2;
    }

    function mirrorTreeV1($root)
    {
        if ($root === null) return $root;
        $temp = $root->left;
        $root->left = $this->mirrorTreeV1($root->right);
        $root->right = $this->mirrorTreeV1($temp);
        return $root;
    }
}
$a = [1,2,2,null,3,null,3];
$root = buildTree($a);
$res = (new Solution())->isSymmetric($root);
var_dump($res);