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

    /**
     * 1 找到数组中的最大值，然后把数组分成两半
     * 2 分别从左右数组中找到最大值，然后用1的 left right 指针指向它
     *
     * @param Integer[] $nums
     * @return TreeNode
     */
    function constructMaximumBinaryTree($nums)
    {
        $cou = count($nums);
        if ($cou == 1) {
            return new TreeNode($nums[0]);
        }
        if ($cou == 0) {
            return null;
        }
        // 找到当前数组下的最大值的索引
        $rootIndex = $this->findMaxIndex($nums, 0, $cou-1);
        $root = new TreeNode($nums[$rootIndex]);

        // 前序遍历，构造树
        // 如果该最大索引的左边还有元素
        if ($rootIndex-1 >= 0) {
            $root->left = $this->constructMaximumBinaryTree(array_slice($nums, 0, $rootIndex)); // 指向左子树
        } else {
            $root->left = null;
        }
        // 如果该最大索引的右边还有元素
        if ($rootIndex+1 <= $cou-1) {
            $root->right = $this->constructMaximumBinaryTree(array_slice($nums, $rootIndex+1,$cou-$rootIndex-1)); // 注意是长度
        } else {
            $root->right = null;
        }
        return $root;
    }

    function findMaxIndex ($nums, $startIndex, $endIndex)
    {
        $maxIndex = $startIndex;
        for ($i = $startIndex+1; $i <= $endIndex; $i++) {
            if ($nums[$maxIndex] < $nums[$i]) {
                $maxIndex = $i;
            }
        }
        return $maxIndex;
    }

    // ----------- 分割线 -------------

    // 不通过切割产生新数组方式，而是用left right控制下标的方法
    function constructMaximumBinaryTreeV2 ($nums)
    {
        return $this->traversal($nums, 0, count($nums)-1);
    }

    function traversal ($nums, $left, $right)
    {
        if ($left > $right) return null;

        $maxIndex = $this->findMaxIndex($nums, $left, $right);
        $root = new TreeNode($nums[$maxIndex]);

        $root->left = $this->traversal($nums, $left, $maxIndex-1);
        $root->right = $this->traversal($nums, $maxIndex+1, $right);
        return $root;
    }


}

/**
 * 输入：nums = [3,2,1,6,0,5]
输出：[6,3,5,null,2,0,null,null,1]
 *
[6,3,5,null,2]
 */
$nums = [3,2,1,6,0,5];
$res = (new Solution())->constructMaximumBinaryTree($nums);
var_dump($res);