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
        // 删除头节点
        while ($head->val == $val) {
            $head = $head->next;
        }
        // 删除啊中间节点
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

    /**
     * 增加虚拟头节点,统一逻辑
     * @param ListNode $head
     * @param Integer $val
     * @return ListNode
     */
    function removeElementsV2($head, $val)
    {
        $dummy = new ListNode(0);
        $dummy->next = $head;
        $pre = $dummy;
        $curr = $dummy->next;

        while ($curr !== null) {
            if ($curr->val == $val) {
                // 需要移除
                $pre->next = $pre->next->next;
                $curr = $pre->next;
            } else {
                $curr = $curr->next;
                $pre = $pre->next;
            }
        }

        return $dummy->next;
    }

}