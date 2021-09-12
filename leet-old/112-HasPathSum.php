<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/5
 * Time: 11:06
 */

/**
 * 给定一个二叉树和一个目标和，判断该树中是否存在根节点到叶子节点的路径，这条路径上所有节点值相加等于目标和。

说明: 叶子节点是指没有子节点的节点。

示例: 
给定如下二叉树，以及目标和 sum = 22，

5
/ \
4   8
/   / \
11  13  4
/  \      \
7    2      1
返回 true, 因为存在目标和为 22 的根节点到叶子节点的路径 5->4->11->2。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/path-sum
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
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

    private $nodeSum = 0;
    /**
     * @param TreeNode $root
     * @param Integer $sum
     * @return Boolean
     */
    function hasPathSum($root, $sum)
    {
//        echo "\n借助 递归 的深度优先遍历\n";
//        $this->preOrder($root);

//        echo "\n借助 栈 的深度优先遍历\n";
//        return $this->preOrderStack($root, $sum);

        return $this->officialSolve($root, $sum);

    }

    function officialSolve ($root, $sum)
    {
        if ($root == null) return false;

        $sum -= $root->val;
        if ($root->left == null && $root->right == null) {
            return $sum == 0;
        }
        return $this->officialSolve($root->left, $sum) || $this->officialSolve($root->right, $sum);
    }

    function preOrder ($root)
    {
        if ($root == null) return false;
        echo $root->val;
        $root->left && $this->preOrder($root->left);
        $root->right && $this->preOrder($root->right);
    }

    // 借助栈的深度优先遍历 -- 解决fail
    function preOrderStack ($root, $sum)
    {
        if ($root == null) return false;
        $arr = [];
        array_push($arr, $root);
        while ($cou = count($arr)) {
            $node = array_pop($arr);

            $this->nodeSum += $node->val;
            if ($node->left == null && $node->right == null) {
                if ($sum == $this->nodeSum) {
                    return true;
                } else {
                    // 减去该根节点的值 -- 没有考虑到不在同一个父节点的其他根节点情况 -- fail
                    $this->nodeSum -= $node->val;
                }
            }

            $node->right && array_push($arr, $node->right);
            $node->left && array_push($arr, $node->left); // 先进后出，现在为中序遍历
        }
        return false;
    }

}

$node1 = new TreeNode(1);
$node2 = new TreeNode(2);
$node3 = new TreeNode(3);
$node1->left = $node2;
$node1->right = $node3;

$s = new Solution();
var_dump($s->hasPathSum($node1,3));