<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * 递归解法
     * 将该链表按 $k 为一组进行翻转
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    function reverseKGroup($head, $k)
    {
        if ($head === null || $head->next === null) return $head;
        $a = $b = $head;
        // 将b指针指向到要翻转数的最末尾，再后一个
        for ($i = 0; $i < $k; $i++) {
            if ($b === null) return $head;
            $b = $b->next;
        }
        // 翻转 $a指针 --> $b 之间的链表（左闭右开），并返回该翻转后链表后的头部
        $newHead = $this->reverse($a, $b);
        $a->next = $this->reverseKGroup($b, $k); // $a 此时为尾部，进行next指向连接下一段节点
        return $newHead; // 返回连接好的起点

    }

    /**
     * 翻转 $head 到 $end 之间的节点
     * @param $head
     * @param $end
     * @return null
     */
    function reverse ($head, $end)
    {
        if ($head === null || $head->next === null) return $head;

        $curr = $head;
        $next = $head->next;
        $next2 = $head->next->next;
        $curr->next = null;
        while ($next !== $end) {
            $next->next = $curr;

            $curr = $next;
            $next = $next2;
            $next2 = $next2->next;
        }
        return $curr; // 返回$curr，则是左闭右开
    }

    // -------下面自己的写法------

    function reverseKGroupMy ($root, $k)
    {
        if ($root === null) {
            return null;
        }
        $newHead = $this->reverseMy($root, $k); // 当前翻转后的头节点
        $last = $root; // 当前翻转后的尾部节点
        $start = $last->next; // 用于移动指向下一段链表串的开头

        while ($start !== null) {
            // 反转剩余节点
            $this->pos = 0;
            $last->next = $this->reverseMy($start, $k);
            $last = $start;
            $start = $last->next;
        }
        return $newHead;
    }
    // 反转链表的前$n位
    private $pos = 0;
    private $next = null; // 第$n+1个位置的元素节点
    private $isEnough = true;
    function reverseMy ($root, $n)
    {
        if ($root === null) {
            // 链表节点数 不足以反转，直接返回原有当前节点
            $this->isEnough = false;
            return null;
        }
        // 后序遍历
        $this->pos++;
        if  ($this->pos === $n) {
            // 到达指定位置，开始往前反转
            $this->next = $root->next;
            return $root;
        }
        $newNode = $this->reverseMy($root->next, $n);
        if (!$this->isEnough) {
            return $root; // 链表节点数 不足以反转，直接返回原有当前节点
        }
        $root->next->next = $root;
        $root->next = $this->next;
        return $newNode; // 返回新的头节点
    }

}