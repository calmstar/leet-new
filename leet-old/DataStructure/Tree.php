<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/22
 * Time: 15:31
 */


/**
 *如何遍历一棵树
有两种通用的遍历树的策略：

深度优先搜索（DFS）
    在这个策略中，我们采用深度作为优先级，以便从跟开始一直到达某个确定的叶子，然后再返回根到达另一个分支。
    深度优先搜索策略又可以根据根节点、左孩子和右孩子的相对顺序被细分为
 * 即：“先序遍历，中序遍历和后序遍历”

宽度优先搜索（BFS）
    我们按照高度顺序一层一层的访问整棵树，高层次的节点将会比低层次的节点先被访问到。
 * 即：层次遍历
 *
 * BFS 和 DFS 主要用在图搜索中

作者：LeetCode
链接：https://leetcode-cn.com/problems/binary-tree-level-order-traversal/solution/er-cha-shu-de-ceng-ci-bian-li-by-leetcode/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
 */


/**
 *
 * 视频资料：https://www.bilibili.com/video/av10472337
 *
 * 树：以二叉树为例讲解
 *
 * 遍历：前序、中序、后序遍历（分别代表根节点的遍历顺序）
 *
 * 例子：
 *            4
 *         /   \
 *        10    3
 *       /  \  /
 *      5   1 2
 *
 * 注意，不要单纯看文字表述的顺序，要看递归的方式写法来看.
 * (每一次递归到的节点，都当作根节点，依此展开左右两棵树，然后按顺序遍历)
 * 前序（根节点->左节点->右节点）：4，10，5，1，3，2
 * 中序（左节点->根节点->右节点）：5, 10, 1, 4, 2, 3
 * 后序（左节点->右节点->根节点）：5, 1, 10, 2, 3, 4
 */
function main () {
    // 上图二叉树的代码结构
    $node1 = new Node();
    $node2 = new Node();
    $node3 = new Node();
    $node4 = new Node();
    $node5 = new Node();
    $node6 = new Node();

    $node1->data = 4;
    $node2->data = 10;
    $node3->data = 3;
    $node4->data = 5;
    $node5->data = 1;
    $node6->data = 2;

    $node1->left = $node2;
    $node1->right = $node3;
    $node2->left = $node4;
    $node2->right = $node5;
    $node3->left = $node6;
    $node3->right = null;
    $node4->left = null;
    $node4->right = null;
    $node5->left = null;
    $node5->right = null;
    $node6->left = null;
    $node6->right = null;

    echo "\n前序遍历：\n";
    preOrder($node1);
    echo "\n中序遍历：\n";
    inOrder($node1);
    echo "\n后序遍历：\n";
    postOrder($node1);

}

class Node {
    public $data = null;
    public $left = null;
    public $right = null;
}


/**
 * (每一次递归到的节点，都当作根节点，依此展开左右两棵树，然后按 根左右 顺序遍历)
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
 * (每一次递归到的节点，都当作根节点，依此展开左右两棵树，然后按 左根右 顺序遍历)
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
 * (每一次递归到的节点，都当作根节点，依此展开左右两棵树，然后按 左右根 顺序遍历)
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

/**
 * 树的 BFS 搜索 ，借助队列完成. 为层次遍历
 * （DFS搜索就为前、中、后序遍历）
 * @param Node $node
 */
function BFS (Node $node)
{
    $queue = [$node]; // 把整个节点存入，方便更新节点
    while (!empty($queue)) {
        $node = array_pop($queue); // 从队头取出元素
        echo $node->data . " "; // 4 10 3 5 1 2
        $node->left && array_unshift($queue, $node->left); // 从队尾补充元素
        $node->right && array_unshift($queue, $node->right); // 从队尾补充元素
    }
}

/*
 * 树的遍历 -- DFS -- 上面的都是使用递归，这里使用 栈 这种数据结构
 * 借助栈的深度优先遍历
 */
function preOrderStack ($root)
{
    if ($root == null) return ;
    $arr = [];
    array_push($arr, $root);
    while ($cou = count($arr)) {
        $node = array_pop($arr);
        echo $node->val;
        $node->right && array_push($arr, $node->right);
        $node->left && array_push($arr, $node->left); // 先进后出，现在为中序遍历
    }
}

main();