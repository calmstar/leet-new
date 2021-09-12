<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/22
 * Time: 17:37
 */

/**
 * 视频资料：https://www.bilibili.com/video/av10472353
 * 二叉搜索树：
 * 根节点比左节点大，比右子节点小
 */
function main ()
{
    $arr = [6, 3, 8, 2, 5, 1, 7];
    $tree = new Tree();
    $tree->root = null;

    foreach ($arr as $v) {
        // 对象本来就是引用传值，不用地址引用符
        insertTree($tree, $v);
    }

    echo "前序遍历：\n";
    preOrder($tree->root); // 6, 3, 2, 1, 5, 8, 7
    echo "\n中序遍历：\n";
    inOrder($tree->root); // 1, 2, 3, 5, 6, 7, 8 （二叉搜索树的中序遍历，是从小到大排列的）
    /**
     * 根据前面两个遍历的结果，可以推导出 二叉树的图（资料：https://www.bilibili.com/video/av7420546）
     *
        中序遍历不能唯一确定一棵二叉搜索树。
        先序和后序遍历不能唯一确定一棵二叉搜索树。
        中序+后序、中序+先序可以唯一确定一棵二叉树。
     *
     *      二叉搜索树：根节点比左节点大，比右子节点小
     *                       6
     *                     /   \
     *                    3     8
     *                  /  \   /
     *                 2    5 7
     *                /
     *               1
     */

    echo "\n高度为：" . getHeight($tree->root) . "\n";
    echo "\n最大值为：" . getMaximum($tree->root) . "\n";
}

/**
 * 找到树的高度
 * @param Node $node
 * @return int
 */
function getHeight (Node $node)
{
    if (empty($node)) {
        return 0;
    }
    $leftHeight = 0;
    $rightHeight = 0;
    if ($node->left) {
        $leftHeight = getHeight($node->left);
    }
    if ($node->right) {
        $rightHeight = getHeight($node->right);
    }
    $max = $leftHeight > $rightHeight ? $leftHeight : $rightHeight;
    return $max + 1;
}

/**
 * 找到树的最大值（通用，非针对二叉搜索树）
 * @param Node $node
 * @return int|null
 */
function getMaximum (Node $node)
{
    if (empty($node)) {
        return  -1;
    }
    $leftMax = 0;
    $rightMax = 0;
    if ($node->left) {
        $leftMax = getMaximum($node->left);
    }
    if ($node->right) {
        $rightMax = getMaximum($node->right);
    }

    $midNum = $node->data;
    $max = $midNum;
    $max = $leftMax > $max ? $leftMax : $max;
    $max = $rightMax > $max ? $rightMax : $max;
    return $max;
}

/**
 * 将元素插入形成二叉查找树
 * @param Tree $tree
 * @param $value
 */
function insertTree (Tree $tree, $value)
{
    // 将 value 包装成node类
    $node = new Node();
    $node->data = $value;
    $node->left = null;
    $node->right = null;

    if (empty($tree->root)) {
        // 这棵树一个节点都没有情况
        $tree->root = $node;
    } else {
        // 有根节点的情况
        $temp = $tree->root;
        while (!empty($temp)) {
            if ($value > $temp->data) {
                // 往右子节点移动
                if (empty($temp->right)) {
                    // 右子节点是空的，直接放入
                    $temp->right = $node;
                    break;
                } else {
                    // 右子节点不是空的，继续循环
                    $temp = $temp->right;
                }

            } else {
                // 往左子节点移动
                if (empty($temp->left)) {
                    // 左子节点是空的，直接放入
                    $temp->left = $node;
                    break;
                } else {
                    // 左子节点不是空的，继续循环
                    $temp = $temp->left;
                }
            }
        }
    }
}

class Node
{
    public $data = null;
    public $left = null;
    public $right = null;
}

class Tree
{
    public $root = null;
}

/**
 * 前序遍历: 根节点->左节点->右节点
 * @param Node $node
 */
function preOrder (Node $node) {
    if (!empty($node)) {
        echo $node->data . ", ";
        $node->left && preOrder($node->left);
        $node->right && preOrder($node->right);
    }
}

/**
 * 中序遍历：左节点->根节点->右节点
 * @param Node $node
 */
function inOrder (Node $node) {
    if (!empty($node)) {
        $node->left && inOrder($node->left);
        echo $node->data . ", ";
        $node->right && inOrder($node->right);
    }
}

/**
 * 后序遍历：左节点->右节点->根节点
 * @param Node $node
 */
function postOrder (Node $node) {
    if (!empty($node)) {
        $node->left && postOrder($node->left);
        $node->right && postOrder($node->right);
        echo $node->data . ", ";
    }
}
main();


