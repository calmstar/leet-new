<?php

/**
 * https://mp.weixin.qq.com/s/o7tdyLiYm668dpUWd-x7Lg
 *
 * 二叉堆其实就是一种特殊的二叉树（完全二叉树），只不过存储在数组里。一般的链表二叉树，我们操作节点的指针，而在数组里，我们把数组索引作为指针
// 父节点的索引
int parent(int root) {
return root / 2;
}
// 左孩子的索引
int left(int root) {
return root * 2;
}
// 右孩子的索引
int right(int root) {
return root * 2 + 1;
}
 *
 * 二叉堆还分为最大堆和最小堆。最大堆的性质是：每个节点都大于等于它的两个子节点。类似的，最小堆的性质是：每个节点都小于等于它的子节点。
 *
 * 二叉堆的操作很简单，主要就是上浮和下沉，来维护堆的性质（堆有序）。
   优先级队列是基于二叉堆实现的，主要操作是插入和删除。
 *      插入是先插到最后，然后上浮到正确位置；
 *      删除是把第一个元素 （最值）调换到最后再删除，然后把新的第1位元素 下沉 到正确位置。
 *
 * 相似 /Users/starc/code/leet-new/sort/nlgn-heapSort.php
 */

function priorityQueue ()
{

}
