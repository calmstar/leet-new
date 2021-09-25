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

    // ---------- 分割线 -----------

    // v1的方法：单层逻辑是让 当前节点 和 传入的父节点（min max节点）进行比较
    // v2的方法：单层逻辑是让 当前节点 和 对应left right 进行比较 。 缺少边界判断

    // v2错误 --- 待修正
    private $min = PHP_INT_MIN; // 左子节点的最小值 min < leftVal < rootVal
    private $max = PHP_INT_MAX; // 右子节点的最大值 rootVal < rightVal < max
    function isValidBSTV2 ($root)
    {
        // 递归出口
        if ($root === null) return true;
        if (!$root->left && !$root->right) return true;

        // 左 ：操作left节点
        $res1 = true;
        if ($root->left) {
            $res1 = $this->isValidBSTV2($root->left);
        }

        // 根：操作val
        if ($root->left && $root->right) {
            if ( ($root->val > $root->left->val) && ($root->val < $root->right->val) && ($root->left->val > $this->min) && ($root->right->val < $this->max)  ) {
                return true;
            } else {
                return false;
            }
        }
        if ($root->left) {
            if ( ($root->val > $root->left->val) && ($root->left->val > $this->min) ) {
                return true;
            } else {
                return false;
            }
        }
        if ($root->right) {
            if ( ($root->val < $root->right->val) && ($root->right->val < $this->max) ) {
                return true;
            } else {
                return false;
            }
        }

        // 右：操作right节点
        $res2 = true;
        if ($root->right) {
            $res2 = $this->isValidBSTV2($root->right);
        }
        return $res1 && $res2;
    }

    // ---------- 分割线 -----------

    // https://mp.weixin.qq.com/s/X21yr0hR8p704im8coSWXA
    // 利用中序遍历就是按顺序排序的特性
    private $arr = [];
    function isValidBSTV3 ($root)
    {
        if ($root === null) return true;

        $res1 = $this->isValidBSTV3($root->left);
        if (!empty($this->arr)) {
            $maxIndex = count($this->arr) - 1;
            if ($this->arr[$maxIndex] >= $root->val) return false;
        }
        $this->arr[] = $root->val;
        $res2 = $this->isValidBSTV3($root->right);
        return $res1 && $res2;
    }

    // 优化：变成只存一个数字，减少空间复杂度
    private $preNum = null;
    function isValidBSTV4 ($root)
    {
        if ($root === null) return true;

        $res1 = $this->isValidBSTV4($root->left);
        if (isset($this->preNum) && $this->preNum >= $root->val) return false;
        $this->preNum = $root->val;
        $res2 = $this->isValidBSTV4($root->right);
        return $res1 && $res2;
    }

}

$root = buildTree([2,1,3]);
$res = (new Solution())->isValidBST($root);
var_dump($res);