<?php
require_once 'tools.php';
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

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST ($root)
    {
        if ($root === null) return true;
        return $this->isValid($root, null, null);
    }
    // 用区间来限制左右子树
    function isValid ($root, $min, $max)
    {
        if ($root === null) return true;
        if ($min !== null && $root->val <= $min->val) return false;
        if ($max !== null && $root->val >= $max->val) return false;

        $res1 = $this->isValid($root->left, $min, $root);
        $res2 = $this->isValid($root->right, $root, $max);
        return $res1 && $res2;
    }
}
$root = buildTree([2,1,3]);
$res = (new Solution())->isValidBST($root);
var_dump($res);