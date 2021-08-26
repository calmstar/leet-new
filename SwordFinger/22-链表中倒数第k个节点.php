<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * 给定一个链表: 1->2->3->4->5, 和 k = 2.
            返回链表 4->5.
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    function getKthFromEnd($head, $k)
    {
        if ($head === null) return $head;
        $fast = $slow = $head;
        while ($k) {
            $fast = $fast->next;
            $k--;
        }
        while ($fast !== null) {
            $fast = $fast->next;
            $slow = $slow->next;
        }
        return $slow;
    }
}