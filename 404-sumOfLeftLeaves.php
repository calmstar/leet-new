<?php

class Solution {

    /**
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

}