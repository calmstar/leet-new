<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/28
 * Time: 16:30
 */

/**
 * 给定一个二叉树，检查它是否是镜像对称的。

例如，二叉树 [1,2,2,3,4,4,3] 是对称的。

1
/ \
2   2
/ \ / \
3  4 4  3
但是下面这个 [1,2,2,null,3,null,3] 则不是镜像对称的:

1
/ \
2   2
\   \
3    3
说明:

如果你可以运用递归和迭代两种方法解决这个问题，会很加分。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/symmetric-tree
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

    private $inOrderArr = [];
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetricFail($root) {
        // 中序遍历后，节点都在数组中对称存储
        $arr = $this->inOrder($root);
        $cou = count($arr);
        if ($cou == 2) {
            return false;
        }

        // 前后指针分别遍历,判断数组是否前后对称即可
        $isSymm = true;
        $j = $cou - 1;
        $i = 0;
        $mid = intval(($i + $j)/2);
        for ($i = 0; $i <= $mid; $i++) {
            if ($arr[$i] != $arr[$j]) {
                $isSymm = false;
                break;
            }
            $j--;
        }
        return $isSymm;

    }


    function isSymmetric ($root)
    {
        return $this->isMirror($root, $root);
    }
    public function isMirror ($t1, $t2)
    {
        if ($t1 == null && $t2 == null) return true;
        if ($t1 == null || $t2 == null) return false;
        return ($t1->val == $t2->val) && $this->isMirror($t1->right, $t2->left) && $this->isMirror($t1->left, $t2->right);
    }


    /**
     * 出错：中序得到结果太麻烦
     * 得到中序遍历后的数组
     * @param $root
     * @return array
     */
    function inOrderFail ($root)
    {
        if (!isset($root->left)) {
            $this->inOrder($root->left);
        } else {
            !isset($root->right) && $this->inOrderArr[] = null;
        }

        $this->inOrderArr[] = $root->val;

        if (!isset($root->right)) {
            $this->inOrder($root->right);
        } else {
            !isset($root->left) && $this->inOrderArr[] = null;
        }

        return $this->inOrderArr;
    }
}

$node1 = new TreeNode(1);
$node2 = new TreeNode(2);
$node3 = new TreeNode(2);
$node1->left = $node2;
$node1->right = $node3;

$node4 = new TreeNode(2);
$node5 = new TreeNode(2);
$node2->left = $node4;
$node3->left = $node5;


$s = new Solution();
var_dump($s->isSymmetric($node1));
