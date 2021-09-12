<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/3
 * Time: 17:55
 */

/**
 *
给定一个二叉树，判断它是否是高度平衡的二叉树。

本题中，一棵高度平衡二叉树定义为：

一个二叉树每个节点 的左右两个子树的高度差的绝对值不超过1。

示例 1:

给定二叉树 [3,9,20,null,null,15,7]

3
/ \
9  20
/  \
15   7
返回 true 。

示例 2:

给定二叉树 [1,2,2,3,3,null,null,4,4]

1
/ \
2   2
/ \
3   3
/ \
4   4
返回 false 。
 */

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

 class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($value) { $this->val = $value; }
 }
class Solution {

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isBalanced($root) {
        return $this->getDiffDepth($root, 'max') - $this->getDiffDepth($root, 'min') > 1 ? false : true;
    }

    private function getDiffDepth ($root, $status)
    {
        if ($root == null) return 0;

        $leftHeight = 0;
        $rightHeight = 0;
        $leftHeight = $this->getDiffDepth($root->left, $status);
        $rightHeight = $this->getDiffDepth($root->right, $status);
        if ($status == 'max') {
            $Height = $leftHeight > $rightHeight ? $leftHeight+1 : $rightHeight+1;
        } else {
            $Height = $rightHeight > $leftHeight ? $leftHeight+1 : $rightHeight+1;
        }
        return $Height;
    }

}

$n1 = new TreeNode(1);
$n2 = new TreeNode(2);
$n3 = new TreeNode(3);
$n4 = new TreeNode(4);
$n5 = new TreeNode(5);
$n1->left = $n2;
$n1->right = $n3;
$n2->left = $n4;
$n4->left = $n5;

$s = new Solution();
$res = $s->isBalanced($n1);
var_dump($res);


class SolutionOfficial {

    function isBalanced($root) {
        $this->depth_diff($root);
        return $this->diff<2;
    }

    private $diff = 0;

    function depth_diff($root){
        if($root==null) return 0;
        $left_depth = $this->depth_diff($root->left);
        $right_depth = $this->depth_diff($root->right);
        $this->diff = max($this->diff,abs($left_depth-$right_depth));
        return max($left_depth,$right_depth)+1;
    }


}

