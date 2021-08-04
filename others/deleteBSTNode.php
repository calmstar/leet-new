<?php

// 删除bst中的节点
function deleteBSTNode ($root, $val)
{
    if ($root === null) return null;
    if ($root->val < $val) {
        // 在右边
        $root->right = deleteBSTNode($root->right, $val);
    }else if ($root->val > $val) {
        // 在左边
        $root->left = deleteBSTNode($root->left, $val);
    } else {
        // 找到了
        // 情况1，该目标节点没有子节点
        if ($root->left === null && $root->right === null) return null;
        // 情况1，该目标节点只有1个子节点
        if ($root->left === null) return $root->right;
        if ($root->right === null) return $root->left;

        // 处理情况 3，该目标节点有2个子节点: 找到左边最大的节点，或右边最小的节点。
        $minNode = getMin($root->right); // 找到右边最小的节点
        $root->val = $minNode->val; // 直接替换值
        $root->right = deleteBSTNode($root->right, $minNode->val); // 将替换上来的节点进行删除
    }
    return $root; // 外层有用当前$root来接收，所以返回的是每一层当前的$root,最终返回的就是根节点$root
}

// 找到$root为根节点的最小的节点 -- bst的最左边
function getMin ($root)
{
    if ($root->left === null) {
        return $root;
    }
    return getMin($root->left); // 外层没有像上面一样用$root接收，所以返回的是递归出口的$root
}

function getMinV2 ($root)
{
   while ($root->left !== null) {
       $root = $root->left;
   }
   return $root;
}