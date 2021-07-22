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
     * @return ListNode
     */
    function middleNode($head) {
        $slow = $head;
        $fast = $head;
        while ($fast !== null && $fast->next !== null) {
            $fast = $fast->next->next;
            $slow = $slow->next;
        }
        return $slow;
    }
}