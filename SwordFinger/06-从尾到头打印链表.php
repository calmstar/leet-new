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
    private $arr = [];

    /**
     * @param ListNode $head
     * @return Integer[]
     */
    function reversePrint($head) {
        if ($head === null) return [];
        $this->reversePrint($head->next);
        $this->arr[] = $head->val;
        return $this->arr;
    }
}