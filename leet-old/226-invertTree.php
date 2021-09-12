<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/5/28
 * Time: 11:39
 */

/**
 * 翻转一棵二叉树。
 *
 * 示例：
 *
 * 输入：
 *
 * 4
 * /   \
 * 2     7
 * / \   / \
 * 1   3 6   9
 * 输出：
 *
 * 4
 * /   \
 * 7     2
 * / \   / \
 * 9   6 3   1
 *
 * 来源：力扣（LeetCode）
 * 链接：https://leetcode-cn.com/problems/invert-binary-tree
 * 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
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
class Solution
{

    /**
     * 错误版本
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTreeMy($root)
    {
        if ($root === null) {
            return $root;
        }
        // 错误，见：https://learnku.com/laravel/t/45157
        $root->left = $this->invertTree($root->right);
        $root->right = $this->invertTree($root->left);
        return $root;
    }


    function invertTree($root)
    {
        if ($root === null) {
            return $root;
        }
        $left = $root->left;
        $right = $root->right;
        $root->left = $this->invertTree($right);
        $root->right = $this->invertTree($left);
        return $root;
    }

    function invertTreeV2($root)
    {
        if (!isset($root)) return $root;

        $tempLeftNode = $root->left;
        $root->left = $root->right;
        $root->right = $tempLeftNode;

        $this->invertTreeV2($root->left);
        $this->invertTreeV2($root->right);
        return $root;
    }

    /**
     * 非递归，采用队列方式，因为看递归时的模型就知道：都是按照节点顺序从左往右依次反转左右根节点的
     * @param $root
     * @return mixed
     */
    function invertTreeV3($root)
    {
        if (!isset($root)) return $root;

        $queue = [];
        array_push($queue, $root);
        while (!empty($queue)) {
            // 交换节点的左右子树
            $node = array_shift($queue);
            $temp = $node->left;
            $node->right = $node->left;
            $node->left = $temp;

            // 将交换后的左右子节点放到队列中
            if ($node->left != null) array_push($queue, $node->left);
            if ($node->right != null) array_push($queue, $node->right);
        }
        return $root;
    }

}