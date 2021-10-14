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
     *  环形链表 II
     * 给定一个链表，返回链表开始入环的第一个节点。 如果链表无环，则返回 null。
     */

    /**
     * https://blog.csdn.net/weixin_42130471/article/details/80703158（博客里的k一定等于1），
     *                                                  具体参考推导（https://leetcode-cn.com/problems/linked-list-cycle-ii/solution/huan-xing-lian-biao-ii-by-leetcode-solution/）
     * 需要点数学推理
     * @param ListNode $head
     * @return ListNode
     */
    function detectCycle($head) {
        $slow = $head;
        $fast = $head;
        while ($fast->next !== null && $fast->next->next !== null) {
            $slow = $slow->next;
            $fast = $fast->next->next;
            if ($slow == $fast) {
                // slow返回到头节点，fast也开始一步一步走
                $slow = $head;
                while ($slow !== $fast) {
                    $fast = $fast->next;
                    $slow = $slow->next;
                }
                return $slow;
            }
        }
        return null;
    }
}