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
     * 将二叉树原地展开
     *      1 将左右节点拉平
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
}

/**
 * 给你二叉树的根结点 root ，请你将它展开为一个单链表：

展开后的单链表应该同样使用 TreeNode ，其中 right 子指针指向链表中下一个结点，而左子指针始终为 null 。
展开后的单链表应该与二叉树 先序遍历 顺序相同。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/flatten-binary-tree-to-linked-list
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */