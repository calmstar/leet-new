<?php
/**
 * https://leetcode-cn.com/problems/aMhZSa/
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

    private $left = null;
    /**
     * @param ListNode $head
     * @return Boolean
     */
    function isPalindrome($head) {
        $this->left = $head;
        return $this->traverse($head);
    }

    function traverse ($node)
    {
        if ($node === null) return true;
        $res = $this->traverse($node->next);
        $res = $res && ($this->left->val === $node->val);
        $this->left = $this->left->next;
        return $res;
    }
}