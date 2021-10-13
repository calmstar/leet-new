<?php

class Solution {
    /**
     * 移除链表元素
     * 题意：删除链表中等于给定值 val 的所有节点。
     */

    /**
     * @param ListNode $head
     * @param Integer $val
     * @return ListNode
     */
    function removeElements($head, $val)
    {
        while ($head->val == $val) {
            $head = $head->next;
        }
        // 中间节点
        $prev = $head;
        $curr = $head->next;
        while ($curr !== null) {
            if ($curr->val == $val) {
                $prev->next = $prev->next->next;
                $curr->next = null;
                $curr = $prev->next;
            } else {
                $curr = $curr->next;
                $prev = $prev->next;
            }
        }
        return $head;
    }

}