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
        $rootIndex = $this->findMaxIndex($nums, 0, $cou-1);
        $root = new TreeNode($nums[$rootIndex]);

        if ($rootIndex-1 >= 0) {
            $root->left = $this->constructMaximumBinaryTree(array_slice($nums, 0, $rootIndex));
        } else {
            $root->left = null;
        }
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