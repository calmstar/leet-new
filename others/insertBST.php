<?php

// 将一个元素插入到bst中
function insertBST ($root, $val)
{
    if ($root === null) return new TreeNode($val);
    if ($val < $root->val) {
        // 左边
        $root->left = $this->insertBST($root->left, $val);
    }
    if ($val > $root->val) {
        // 右边
        $root->right = $this->insertBST($root->right, $val);
    }
    return $root;
}
