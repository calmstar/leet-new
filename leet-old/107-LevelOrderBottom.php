<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/1
 * Time: 14:38
 */

/**
 * 给定一个二叉树，返回其节点值自底向上的层次遍历。 （即按从叶子节点所在层到根节点所在的层，逐层从左向右遍历）

例如：
给定二叉树 [3,9,20,null,null,15,7],

3
/ \
9  20
/  \
15   7
返回其自底向上的层次遍历为：

[
[15,7],
[9,20],
[3]
]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/binary-tree-level-order-traversal-ii
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
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrderBottom($root) {
        $res = [];
        $this->recursiveHelp($root, 0, $res);
        return $res;
    }

    private function recursiveHelp ($root, $level, &$res)
    {
        if ($root == null) return ;
        if (count($res) == $level) array_unshift($res, []); // [[]] 二维
        array_push($res[count($res) - $level - 1], $root->val);
        $this->recursiveHelp($root->left, $level + 1, $res);
        $this->recursiveHelp($root->right, $level + 1, $res);
    }
}

/**
 * 网上解法
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class SolutionOfficial {

    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrderBottom($root) {
        $res = [];
        $this->level($root, 0, $res);
        return $res;
    }

    function level($root, $level, &$res)
    {
        if($root == null) return;
        if($level == count($res)){
            array_unshift($res,[]);//递归进来的先插一个空数组在头部
        }
        //计算在那个key   count($res) - $level - 1
        array_push($res[count($res) - $level - 1], $root->val);
        $this->level($root->left, $level+1, $res);
        $this->level($root->right, $level+1, $res);
    }

}

