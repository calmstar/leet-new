<?php

// 在bst中寻找一个数字 -- 根据 bst 特性进行寻找
function isInBST ($root, $target)
{
    if ($root === null) return false;
    if ($target < $root->val) {
        // 目标在根节点左边
        return $this->isInBST($root->left, $target);
    } elseif ($target > $root->val) {
        // 目标在根节点右边
        return $this->isInBST($root->right, $target);
    }else {
        // 找到
        return true;
    }
}

// 穷举搜索整棵树，找到对应数字
function isInBSTV1 ($root, $target)
{
    if ($root === null) return false;
    if ($root->val === $target) return true;
    return $this->isInBST($root->left, $target) || $this->isInBST($root->right, $target);
}