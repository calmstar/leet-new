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

    // ---------- 方法3 ----------
    // 利用特殊技巧，时间复杂度O(n)  空间复杂度O(1)
    // https://mp.weixin.qq.com/s/tCgEoOlZKS_ohuTx1VxJ-Q
    function isPalindrome ($head)
    {
       // 1 利用快慢指针找到链表中间节点
        $fast = $head;
        $slow = $head;
        while ($fast !== null && $fast->next !== null) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        // 如果 $fast 不为空，说明该链表是奇数，slow指针需要往前移动一格才是需要翻转的起点
        if ($fast !== null) {
            $slow = $slow->next;
        }
        // 开始翻转 slow 之后的节点，返回的$reverseHead在尾部节点
        $reverseHead =  $this->reverseList($slow);
        // 翻转之后，$head节点在前面开始遍历，$reverseHead在后面往前遍历，依次比较
        while ($reverseHead !== null) {
           if ($reverseHead->val !== $head->val) return false;
            $head = $head->next;
            $reverseHead = $reverseHead->next;
        }
        return true;
    }




    // ---------- 方法2 ----------

    private $left = null;
    // 通过后序遍历：时间复杂度O（n），空间复杂度都是O(n) - 共用了同个链表，但是有递归空间，O（n）
    function isPalindromeBackend ($head)
    {
        $this->left = $head;
        return $this->traverse($head);
    }

    function traverse ($head)
    {
        if ($head === null) return true;
        $res = $this->traverse($head->next);
        // 后序遍历 ，此时第一次走到这里的时候 $head 是尾部节点，然后开始"归"
        $res = $res && $head->val == $this->left->val;
        $this->left = $this->left->next;
        return $res;
    }

    // ---------- 方法1 ----------

    /**
     * 判断是否回文链表 -- 通过翻转链表值赋予到新链表，注意使用临时指针指向
     *  --- 也可以将元素值存在栈中，然后出栈依次跟链表比较
     * 时间和空间复杂度都是O(n)
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