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
     * 将二叉树原地展开
     *      1 将左右节点拉平 -- 后序遍历，"递"到剩下最后一个节点
     *      2 将拉平的左节点，连接到右节点中
     * @param TreeNode $root
     * @return NULL
     */
    function flatten($root)
    {
        if ($root === null) return null;

        // 后序遍历，到最底层的节点就只有一个了
        $this->flatten($root->left);
        $this->flatten($root->right);

        // 开始"归"
        $left = $root->left;
        $right = $root->right;
        // 要求跟先序遍历的顺序一样，需要把左节点先放在根节点后面
        $root->left = null;
        $root->right = $left;
        // 将刚凑过来的旧左节点遍历到尾部，再补上旧的右节点
        $curr = $root;
        while ($curr->right !== null) {
            $curr = $curr->right;
        }
        $curr->right = $right;
    }

    // ----- 自己写的 ----
    function my ($root)
    {
        if ($root === null) return null; // 这个肯定要返回null
        if ($root->left === null && $root->right === null) return null; // 当没有子节点的时候也要返回null

        $this->my($root->left);
        $this->my($root->right);
        // 到达该节点的最右子节点
        $curr = $root->left;
        if ($curr === null) return $root;
        while ($curr->right !== null) {
            $curr = $curr->right;
        }
        $curr->right = $root->right;
        $root->right = $root->left;
        $root->left = null;
        return $root;
    }
}
$arr = [1,2,5,3,4,null,6];
$root = buildTree($arr);
$res = (new Solution())->my($root);
print_r($res);

/**
 * 给你二叉树的根结点 root ，请你将它展开为一个单链表：

展开后的单链表应该同样使用 TreeNode ，其中 right 子指针指向链表中下一个结点，而左子指针始终为 null 。
展开后的单链表应该与二叉树 先序遍历 顺序相同。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/flatten-binary-tree-to-linked-list
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */