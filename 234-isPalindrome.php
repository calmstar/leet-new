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
     * 判断是否回文链表 -- 通过翻转链表值赋予到新链表，注意使用临时指针指向
     * @param ListNode $head
     * @return Boolean
     */
    function isPalindromeByNewNodeReverse($head)
    {
        // 翻转链表再进行比较 -- 需要新开一个链表，不能用同一个链表，否则 head 指向会变成指到最后的节点
        $newNode = new ListNode(); // 作为哨兵节点
        $tempHead = $head; // 必须要固定好头部，让一个临时指针去遍历
        $tempNewNode = $newNode;
        while ($tempHead !== null) {
            $tempNewNode->next = new ListNode($tempHead->val);

            $tempHead = $tempHead->next;
            $tempNewNode = $tempNewNode->next;
        }
        $newHead = $newNode->next;

        // 翻转链表
        $rev = $this->reverseList($head);
        while ($newHead !== null || $rev !== null) {
            if ($newHead->val !== $rev->val) {
                return false;
            }
            $newHead = $newHead->next;
            $rev = $rev->next;
        }
        return true;
    }

    function reverseList ($head)
    {
        if ($head === null || $head->next === null) return $head;

        $curr = $head;
        $next = $head->next;
        $next2 = $head->next->next;
        $curr->next = null;

        while ($next !== null) {
            $next->next = $curr;

            $curr = $next;
            $next = $next2;
            $next2 = $next2->next;
        }
        return $curr;
    }

}