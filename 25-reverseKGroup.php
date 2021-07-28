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
        $a->next = $this->reverseKGroup($b, $k);
        return $newHead;

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

}