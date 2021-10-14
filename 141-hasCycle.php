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
     * 环形链表
     * 如果链表中存在环，则返回 true 。 否则，返回 false 。
    进阶：
    你能用 O(1)（即，常量）内存解决此问题吗？
     */

    /**
     * 快慢指针，
     * 如果有环，则快慢指针一定会相遇
     * 如果没环，快指针会跳出去
     *
     * @param ListNode $head
     * @return Boolean
     */
    function hasCycle($head) {
        $fast = $head;
        $slow = $head;
        while ($fast->next !== null && $fast->next->next !== null) {
            $slow = $slow->next;
            $fast = $fast->next->next;
            if ($slow == $fast) {
                return true;
            }
        }
        return false;

    }
}