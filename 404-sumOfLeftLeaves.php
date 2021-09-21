<?php

class Solution {

    /**
     * 前序遍历
     * @param TreeNode $root
     * @return Integer
     */
    function sumOfLeftLeaves($root)
    {
        $this->solve($root, false);
        return $this->sum;
    }

    private $sum = 0;
    function solve ($node, $isLeft)
    {
        if ($isLeft && $node->left !== null && $node->right !== null) {
            $this->sum += $node->val;
        }
        $node->left && $this->solve($node->left, true);
        $node->right && $this->solve($node->right, false);
    }

    // ------------------- 分割线 -------------------

    // 后序遍历，因为要通过左右树的节点总值来返回，从下往上推
    function sumOfLeftLeavesV2 ($root)
    {
        if ($root === null) return 0;

        $leftValue = $this->sumOfLeftLeavesV2($root->left);
        $rightValue = $this->sumOfLeftLeavesV2($root->right);

        $midValue = 0;
        if ($root->left && !$root->left->left && !$root->left->right) {
            $midValue = $root->left->val;
        }
        $sum = $midValue + $leftValue + $rightValue;
        return $sum;
    }

}