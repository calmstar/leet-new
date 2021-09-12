<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/27
 * Time: 20:40
 */

/**
 * 给定两个二叉树，编写一个函数来检验它们是否相同。

如果两个树在结构上相同，并且节点具有相同的值，则认为它们是相同的。

示例 1:

输入:       1         1
            / \       / \
            2   3     2   3

[1,2,3],   [1,2,3]

输出: true
示例 2:

输入:      1          1
        /           \
        2             2

[1,2],     [1,null,2]

输出: false
示例 3:

输入:       1         1
            / \       / \
            2   1     1   2

[1,2,1],   [1,1,2]

输出: false

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/same-tree
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

    /**
     * @param TreeNode $p
     * @param TreeNode $q
     * @return Boolean
     */
    function isSameTree($p, $q) {
        while (!empty($p) || !empty($q)) {
            if (!empty($p) && empty($q)) {
                return false;
            }
            if (!empty($q) && empty($p)) {
                return false;
            }
            if ($p->val != $q->val) {
                return false;
            }

            if ($p->left || $q->left) {
                $flag = $this->isSameTree($p->left, $q->left);
                if (!$flag) return false;
            }

            if ($p->right || $q->right) {
                $flag = $this->isSameTree($p->right, $q->right);
                if (!$flag) return false;
            }
            return true;
        }
        return true;
    }
}

$t1 = new TreeNode(1);
$t2 = new TreeNode(2);
$t3 = new TreeNode(3);
$t1->left = $t2;
$t1->right = $t3;

$t11 = new TreeNode(1);
$t22 = new TreeNode(2);
$t33 = new TreeNode(3);
$t11->left = $t22;
$t11->right = $t33;

$s = new Solution();
var_dump($s->isSameTree($t1, $t11));