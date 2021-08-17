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

    private $reverseRoot = null; // 记录递归出口，得到反转后的头指针

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        $this->reverse($head); // 需要借助辅助函数递归：因为递归函数中需要返回当前节点，题目要返回反转后的头节点
        return $this->reverseRoot; // 返回翻转后的头指针
    }
    function reverse ($head)
    {
        if ($head === null) return null;
        // "递"步骤
        $res = $this->reverse($head->next); // 以此为界
        // "归"步骤
        if ($res === null) {
            $this->reverseRoot = $head; // 记录递归出口，得到反转后的头指针
            return $head;
        }
        // $res 如果不为null，则是当前head节点的旧next节点
        $res->next = $head;
        $head->next = null;
        return $head; // 返回当前节点
    }


    // 不需要辅助函数
    function reverseListV2 ($head)
    {
        if ($head === null || $head->next === null) return $head;
        $last = $this->reverseListV2($head->next);
        $head->next->next = $head; // 利用当前节点原有的指针指向进行操作
        $head->next = null;
        return $last;
    }

}