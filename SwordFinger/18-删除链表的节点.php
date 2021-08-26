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
     * @param ListNode $head
     * @param Integer $val
     * @return ListNode
     */
    function deleteNode($head, $val)
    {
        if ($head === null) return $head;
        $tmp = new ListNode();
        $res = $tmp;
        $tmp->next = $head;
        while ($tmp->next !== null) {
            if ($tmp->next->val === $val) {
                $tmp->next = $tmp->next->next;
                break;
            } else {
                $tmp = $tmp->next;
            }
        }
        return $res->next;
    }
}




