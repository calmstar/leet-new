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

    private $successor = null;

    /**
     * https://mp.weixin.qq.com/s/5wz_YJ3lTkDH3nWfVDi5SA
     * 翻转 m-n 之间的链表
     * @param ListNode $head
     * @param Integer $left
     * @param Integer $right
     * @return ListNode
     */
    function reverseBetween($head, $left, $right)
    {
        // base case -- 把m-n这段的链表进行翻转后返回，然后拼凑到原链表
        if ($left == 1) {
            return $this->reverseN($head, $right);
        }
        // 前进到反转的起点触发 base case,
        $head->next = $this->reverseBetween($head->next, $left - 1, $right - 1);
        return $head;
    }

    // 翻转前n个节点
    function reverseN ($head, $n)
    {
        // 题目定义的$n,是从1开始的。与翻转整个链表不同，这个只是翻转前n，所以递归出口条件不同
        if ($n == 1) {
            $this->successor = $head->next; // 记录第n+1个节点,为最后的指向
            return $head; // 翻转后的头节点
        }
        $last = $this->reverseN($head->next, $n-1);
        $head->next->next = $head;
        $head->next = $this->successor; // 最后的节点指向不再是null，而是successor
        return $last;
    }

}