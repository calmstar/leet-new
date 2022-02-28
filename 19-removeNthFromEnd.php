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
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        if ($head === null) return $head;
        $dummy = new ListNode(0);
        $dummy->next = $head;
        $slow = $dummy;
        $fast = $dummy;
        while ($n) {
            $fast = $fast->next;
            $n--;
        }
        while ($fast && $fast->next) {
            $slow = $slow->next;
            $fast = $fast->next;
        }
        $slow->next = $slow->next->next;
        return $dummy->next;
    }
}