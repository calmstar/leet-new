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
     * @param ListNode $headA
     * @param ListNode $headB
     * @return ListNode
     */
    function getIntersectionNode($headA, $headB) {
        if ($headA === null || $headB === null) return null;
        // 分别计算 a b 的长度
        $aLen = 0;
        $tempLenA = $headA;
        while ($tempLenA) {
            $aLen++;
            $tempLenA = $tempLenA->next;
        }
        $bLen = 0;
        $tempLenB = $headB;
        while ($tempLenB) {
            $bLen++;
            $tempLenB = $tempLenB->next;
        }

        if ($aLen > $bLen) {
            $diffLen = $aLen - $bLen;
            while ($diffLen) {
                $headA = $headA->next;
                $diffLen--;
            }
        } else{
            $diffLen = $bLen - $aLen;
            while ($diffLen) {
                $headB = $headB->next;
                $diffLen--;
            }
        }
        // ab链表一样长了
        while ($headA && $headB) {
            if ($headA === $headB) return $headA;
            $headB = $headB->next;
            $headA = $headA->next;
        }
        return null;
    }
}