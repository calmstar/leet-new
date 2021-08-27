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
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2)
    {
        if ($l1 === null) return $l2;
        if ($l2 === null) return $l1;

        $newList = new ListNode(); // 哨兵节点
        $tmp = $newList;
        while ($l1 !== null && $l2 !== null) {
            if ($l1->val < $l2->val) {
                $tmp->next = $l1;
                $l1 = $l1->next;
            } else {
                $tmp->next = $l2;
                $l2 = $l2->next;
            }
            $tmp = $tmp->next;
        }
        if ($l1 !== null) {
            $tmp->next = $l1;
        }
        if ($l2 !== null) {
            $tmp->next = $l2;
        }
        return $newList->next;
    }
}