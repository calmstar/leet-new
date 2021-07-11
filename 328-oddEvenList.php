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
    function oddEvenList($head) {
        if ($head === null) return null;

        $odd = $head; // 奇数指针
        $even = $head->next; // 偶数指针
        $tmp = $even; // 暂时存储奇数指针的开头，用于给偶数指针的末尾指向这里的开头，形成链路

        // while ($odd->next && $odd->next->next) {
        //     $odd->next = $odd->next->next;
        //     $odd = $odd->next;
        // }
        // while ($even->next && $even->next->next) { // 会导致后面有环
        //     $even->next = $even->next->next;
        //     $even = $even->next;
        // }

        while ($even !== null && $even->next !== null) {
            $odd->next = $odd->next->next;
            $odd = $odd->next;
            $even->next = $even->next->next;
            $even = $even->next;
        }
        $odd->next = $tmp;
        return $head;
    }
}