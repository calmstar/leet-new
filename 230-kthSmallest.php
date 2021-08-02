<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    private $count = 0;
    private $val = 0;
    private $arr = [];

    function xx () {
        echo 44  . PHP_EOL;

    }


    /**
     * 中序遍历二叉搜索树即可
     * @param TreeNode $root
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($root, $k)
    {
        if ($root === null) return;

        $this->count++;
        $this->kthSmallest($root->left, $k);
//        array_push($arr, $root->val);
//        if ($this->count == $k) {
//            $this->val = $root->val;
//            return;
//        }
        $this->debug($this->deep++, "{$root->val} -- $this->count");
        $this->kthSmallest($root->right, $k);
        return $this->val;
    }

    // 递归调试代码
    private $deep = 0;
    function debug ($deep, $str = '')
    {
        $space = '--';
        for ($i = 0; $i < $deep; $i++) {
            $space = $space . '--';
        }
        echo $space . ': '. $str . PHP_EOL;
    }
}
echo 11 . PHP_EOL;
(new Solution())->xx();
var_dump(222);