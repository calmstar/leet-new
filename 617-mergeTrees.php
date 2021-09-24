<?php
require_once 'tools.php';

class Solution {

    /**
     * 二叉树递归什么时候要接收返回值？
     *      取某条路径，求最值（比较左右子树）
     *      其实大部分情况下都可以用全局变量保存好
     *
     * 二叉树递归什么时候不要接收返回值？
     *      取所有路径（全局变量保存）
     *
     * 二叉树递归单层逻辑？
     *      取当前元素操作 or 取当前元素和子元素 or 取当前元素和父元素
     *      让空节点进入递归逻辑 or 不让空节点进入
     *
     * 二叉树递归结束条件？
     *      判断当前节点 or 判断子节点
     */

    /**
     * 合并两棵二叉树
     * 自己写的
     * @param TreeNode $root1
     * @param TreeNode $root2
     * @return TreeNode
     */
    function mergeTrees($root1, $root2)
    {
        if (!$root1 && !$root2) return null;

        $root1 = $root1 === null ? new TreeNode(0) : $root1;
        $root2 = $root2 === null ? new TreeNode(0) : $root2;
        $root1->val += $root2->val;

        if ($root1->left || $root2->left) {
            // 以 $a = [1,2]; $b = [1,null,2]; 为例
            // 需要用 $root1->left 进行指向，不然 root1 无法指向第三个节点（第三个节点root1是null，需要后面创建，但未产生关联，所以需要返回并指向）
            $root1->left = $this->mergeTrees($root1->left, $root2->left);
        }
        if ($root1->right || $root2->right) {
            $root1->right = $this->mergeTrees($root1->right, $root2->right);
        }
        return $root1;
    }

    // ------------- 分割线 --------------

    // https://mp.weixin.qq.com/s/tzjZxflogS6UJ3W3QGrIkQ
    function mergeTreesV2 ($root1, $root2)
    {
        if ($root1 === null) return $root2;
        if ($root2 === null) return $root1;

        $root1->val += $root2->val;  // 前中后序都可以
        $root1->left = $this->mergeTreesV2($root1->left, $root2->left);
//         $root1->val += $root2->val;
        $root1->right = $this->mergeTreesV2($root1->right, $root2->right);
//         $root1->val += $root2->val;
        return $root1;
    }

    // ------------- 分割线 --------------

    // 创建新节点
    function mergeTreesV3 ($root1, $root2)
    {
        if ($root1 === null) return $root2;
        if ($root2 === null) return $root1;
        $newNode = new TreeNode(0);
        $newNode->val = $root1->val + $root2->val; // 前中序遍历都可以
        $newNode->left = $this->mergeTreesV3($root1->left, $root2->left);
        $newNode->right = $this->mergeTreesV3($root1->right, $root2->right);
        return $newNode;
    }

}
$a = [1,3,2,5];
$b = [2,1,3,null,4,null,7];
$a = [1,2];
$b = [1,null,2];

$root1 = buildTree($a);
$root2 = buildTree($b);
$res = (new Solution())->mergeTrees($root1, $root2);
print_r($res);
