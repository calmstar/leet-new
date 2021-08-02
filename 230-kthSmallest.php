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
    private $count = 0;
    private $val = 0;

    function kthSmallest($root, $k)
    {
        $this->traverse($root, $k);
        return $this->val;
    }
    function traverse ($root, $k)
    {
        if ($root === null) return;

        $this->traverse($root->left, $k);
        $this->count++; // 注意是中序遍历 count++要放在中间，放在其他地方会出问题
        if ($k == $this->count) {
            $this->val = $root->val;
            return;
        }
        $this->traverse($root->right, $k);
    }

    /**
     * 我的解法
     * 中序遍历二叉搜索树即可
     * @param TreeNode $root
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestMy($root, $k)
    {
        if ($root === null) return;

        $this->kthSmallest($root->left, $k);
        $this->count++;
        if ($this->count == $k) {
            $this->val = $root->val;
            return $this->val;  // 防止[1] 1 的情况，只有一个元素
        }
//       debug($this->deep++, "{$root->val} -- $this->count");
        $this->kthSmallest($root->right, $k);
        return $this->val;
    }
    // 递归调试代码
    private $deep = 0;
}


$arr = [3,1,4,null,2];
$root = buildTree($arr);

// 得到从小到大，第k位的数字
$k = 2;
$res = (new Solution())->kthSmallest($root, $k);
var_dump($res);

