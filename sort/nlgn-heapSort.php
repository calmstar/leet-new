<?php

/**
 * 堆
 * 参考视频：https://www.bilibili.com/video/av47196993?from=search&seid=14755150340235478837
 *
 * 可以使用数组形式存储。
 * （由于堆必须是一棵完全二叉树，所以子节点都是从上往下、从左到右依次展示的，不会有元素跳过的情况存在，符合数组的存储特点）
 *
 * 树：某个节点有一个或多个子节点的数据结构
 * 二叉树：子节点最多有两个
 * 满二叉树：子节点只能有两个。与下面的完全二叉树，是同一个维度下概念。
 * 完全二叉树：叶子节点都在最底下两层，最后一层叶子节都靠左排列，并且除了最后一层，其他层的节点个数都要达到最大（2个）
 *
 * 堆：   基础条件是一棵完全二叉树。
 * 大顶堆：每个节点的值都大于或等于其左右孩子节点的值
 * 小顶堆：每个节点的值都小于或等于其左右孩子节点的值
 * 知道某个节点位置i，计算得到子节点：左（2i+1），右（2i+2）,父（(i-1)/2）
 *
 * 二叉查找树：BST, 根节点比左节点大，比右子节点小
 * 平衡二叉树：它是一棵空树或它的左右两个子树的高度差的绝对值不超过1，并且左右两个子树都是一棵平衡二叉树。
 *           平衡二叉树的常用算法有红黑树、AVL、Treap、伸展树、SBT等。
 *
 * 平衡二叉查找树：是一种结构平衡的二叉搜索树，即叶节点高度差的绝对值不超过1，并且左右两个子树都是一棵平衡二叉树。
 *
 * B树（B-树）：多路平衡查找树，它的每个节点最多包含k个孩子，k就被称为B树的阶。
 *
 */
/**
 * 初始化堆的复杂度为O(n)：
 *      对于每个非叶子结点，都要调用buildHeap，将它与它的孩子结点进行比较和交换，顺序是从后向前。
 *      buildHeap方法
 *
 * 调整堆的复杂度为O(n*log n)
 *         heapSort：每次从堆顶拿走一个节点，然后将堆尾元素放到堆顶再进行堆化。
 *                  分析：共需要拿走 n 个节点；
 *                      每拿走一个节点需要堆化，操作的时间复杂度 logN，即跟该节点所在的高度有关
 *                  所以：调整n个节点为 O(N logN)
 *
 * 所以，总体复杂度为O(n*log n)
 */
/**
 * 例子：这是一棵完全二叉树，下面进行堆化，大顶堆
 *           4           堆化后 ：      10
 *         /   \                    /   \
 *        10    3                  5    3
 *       /  \  /                 /  \  /
 *      5   1 2                 4   1 2
 */

function main ()
{
    // 根据上面的二叉树元素位置，依次存储到数组中，从上到下，从左到右
    $arr = [4, 10, 3, 5, 1, 9];
    $arr = buildHeap($arr);
    $arr = heapSort($arr);
    var_dump($arr);
}

/**
 * 堆排序
 * @param $arr
 * @return mixed
 */
function heapSort ($arr) {
    // 得到一个符合 堆结构存储 的数组
    $arr = buildHeap($arr);
    $cou = count($arr);
    $sortedArr = []; //前面得到大顶堆，后面拿出来就是逆序排列的数字
    for ($i = $cou - 1; $i >= 0; $i--) {
        $sortedArr[] = $arr[0]; // 将祖先节点（大顶堆为最大的数）放到已排序好的数组中
        swap($arr, $i, 0); // 将祖先节点跟最后的叶子节点交换
        unset($arr[$i]); // 防止影响 $cou
        heapify($arr, 0); // 取了0位置的数，就重新构造大顶堆；虽然heapify只构造一边，但是仍然可以，因为$arr本身其他的边就被构造好了
    }
    return $sortedArr;
}

/**
 * 建立一个完整的堆，大顶堆
 *
 *  倒序堆化的顺序： 3 -> 10 -> 4
 *    开始：  4       父节点3进行堆化 ：  4      父节点10进行堆化 ：  4    父节点4进行堆化① ： 10   父节点4进行堆化② ：  10
 *         /   \                    /   \                    /   \                  /   \                    /   \
 *        10    3                 10    9                  10    9                4    9                    5    9
 *       /  \  /                 /  \  /                 /  \  /                /  \  /                   /  \  /
 *      5   1 9                 5   1 3                 5   1 3                5   1 3                   4   1 3
 *
 * @param $arr
 * @return mixed
 */
function buildHeap ($arr)
{
    $cou = count($arr);
    $lastNode = $cou - 1; // 完全二叉树，用数组存储，最后一个叶子节点的索引就等于数组末尾索引
    $lastNodeParent = ($lastNode - 1) / 2;

    // 倒序将一棵棵完全二叉树堆化
    for ($i = $lastNodeParent; $i >= 0; $i--) {
        heapify($arr, $i);// 引用传值，直接修改数组 $arr 内的值
    }
    // 返回从内部修改过位置的数组，则此数组就可以表示堆
    return $arr;
}

/**
 * 堆化
 * 一次堆化,只能堆化一条路径下来，不能把一棵完全二叉树完全堆化下来。
 *
 * 每进行一次heapify,就是处理该父节点的二叉树，及其左右子节点的二叉树 进行堆化
 *
 * 所以上面 buildHeap 函数就进行了多次堆化
 * @param $arr 需要进行堆化的数组
 * @param $index 需要从哪个位置开始进行向下堆化
 */
function heapify (&$arr, $index)
{
    // 递归出口
    $cou = count($arr);
    if ($index >= $cou) {
        return ;
    }

    $leftChild = 2 * $index + 1;
    $rightChild = 2 * $index + 2;
    $maxIndex = $index;

    // 假设索引i为当前这棵二叉树的父元素，依次跟左右两个子节点进行比较，得到该棵树最大的元素索引，然后替换值到父节点上
    if ($leftChild < $cou && $arr[$leftChild] > $arr[$maxIndex]) {
        $maxIndex = $leftChild;
    }
    if ($rightChild < $cou && $arr[$rightChild] > $arr[$maxIndex]) {
        $maxIndex = $rightChild;
    }
    if ($maxIndex != $index) {
        swap($arr, $index, $maxIndex);
        heapify($arr, $maxIndex);
    }
}

/**
 * 交换元素的位置，引用传值
 * @param $arr
 * @param $i
 * @param $j
 */
function swap (&$arr, $i, $j) {
    $temp = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $temp;
}

main();