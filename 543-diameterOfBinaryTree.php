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
     * 给定一棵二叉树，你需要计算它的直径长度。
     * 一棵二叉树的直径长度是任意两个结点路径长度中的最大值。这条路径可能穿过也可能不穿过根结点。

    示例 :
    给定二叉树
        1
      /  \
     2   3
    / \
   4   5
    返回3, 它的长度是路径 [4,2,1,3] 或者[5,2,1,3]。

    注意：两结点之间的路径长度是以它们之间边的数目表示。
     *
     * 每一条二叉树的「直径」长度就是一个节点的 左右子树的最大深度之和 。

    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/diameter-of-binary-tree
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     */

    private $maxDiameter = 0;
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function diameterOfBinaryTree($root)
    {
        $this->getDiameter($root);
        return $this->maxDiameter;
    }

    private function getDiameter ($root)
    {
        if ($root === null) return 0;
        $leftMax = $this->getDiameter($root->left);
        $rightMax = $this->getDiameter($root->right);
        // 求得当前节点的直径 $tempDiameter
        $tempDiameter = $leftMax + $rightMax;
        $this->maxDiameter = max($tempDiameter, $this->maxDiameter);

        // 上一个节点看当前节点，只能选择一条最深的路径
        return 1 + max($leftMax, $rightMax);

    }

}