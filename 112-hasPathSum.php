<?php

class Solution {

    /**
     * 路径总和
     * @param TreeNode $root
     * @param Integer $targetSum
     * @return Boolean
     */
    function hasPathSum($root, $targetSum)
    {
        if ($root === null) return false;

        if ($root->left === null && $root->right === null) {
            $this->pathSum += $root->val;
            return $this->pathSum == $targetSum;
        }

        $this->pathSum += $root->val;
//        if ($this->pathSum > $targetSum) return false; // 可能存在负数

        if ($root->left) {
            $resLeft = $this->hasPathSum($root->left, $targetSum);
            $this->pathSum -= $root->left->val; // 全局变量 回溯
            if ($resLeft) {
                return true;
            }
        }
        if ($root->right) {
            $resRight = $this->hasPathSum($root->right, $targetSum);
            $this->pathSum -= $root->right->val; // 回溯
            if ($resRight) {
                return true;
            }
        }
        return false;
    }
    private $pathSum = 0;

    // -------------- 分割线 -------------

    // 换种角度进行解决: 将数值进行处理后再进行判断
    function hasPathSumV2($root, $targetSum)
    {
        if ($root === null) return false;
        return $this->traversal($root, $targetSum-$root->val);
    }

    function traversal ($node, $count)
    {
        if (!$node->left && !$node->right && $count == 0) return true; // 跟上面解决思路不同，这里的count是已经计算好的
        if (!$node->left && !$node->right) return false; // count不为0，说明这条路径不符合

        // 不将空节点进入该函数中
        if ($node->left) {
//            $count -= $node->left->val; // 下面（$count - $node->left->val）包含回溯的逻辑
            $resLeft = $this->traversal($node->left, $count - $node->left->val);
//            $count += $node->left->val;

            if ($resLeft) return true;
        }
        if ($node->right) {
//            $count -= $node->right->val;
            $resRight = $this->traversal($node->right, $count - $node->right->val);
//            $count += $node->right->val;
            if ($resRight) return true;
        }
        return false;
    }

    // -------------- 分割线 -------------

    // 不推荐，看不出前中后序遍历 https://mp.weixin.qq.com/s/EJr_nZ31TnvZmptBjkDGqA
    function hasPathSumV3 ($root, $targetSum)
    {
        if ($root === null) return false;
        if (!$root->left && !$root->right && $targetSum == $root->val) return true; // 跟上面解决思路不同，这里的count是已经计算好的

        return $this->hasPathSumV3($root->left, $targetSum-$root->val) || $this->hasPathSumV3($root->right, $targetSum-$root->val);
    }

    // -------------- 分割线 -------------

    // 迭代法: 首先参考前序遍历的迭代法 - 144
    // 核心，stack里面的元素是一个数组：[stack, val]
    function hasPathSumV4 ($root, $targetSum)
    {
        if ($root === null) return false;
        $stack = [];
        array_push($stack, [$root, $root->val]);
        while (!empty($stack)) {
            $arr = array_pop($stack);
            $node = $arr[0];
            $val = $arr[1];

            if (!$node->left && !$node->right && $targetSum == $val) {
                return true;
            }
            if ($node->right) {
                array_push($stack, [$node->right, $node->right->val + $val]); // $root->right->val + $val 已经包含了回溯
            }
            if ($node->left) {
                array_push($stack, [$node->left, $node->left->val + $val]);
            }
        }
        return false;
    }

}