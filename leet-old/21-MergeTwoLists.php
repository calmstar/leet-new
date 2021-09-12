<?php

/**
 *将两个有序链表合并为一个新的有序链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。 

 示例：

 输入：1->2->4, 1->3->4
 输出：1->1->2->3->4->4

 来源：力扣（LeetCode）
 链接：https://leetcode-cn.com/problems/merge-two-sorted-lists
 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 *
 * */
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
    // 递归实现
    function mergeTwoLists($l1, $l2) {

        if(empty($l1)) return $l2;
        if(empty($l2)) return $l1;

        if($l1->val<= $l2->val) {
            $l1->next = $this->mergeTwoLists($l1->next,$l2);
            return $l1;
        }else{
            $l2->next = $this->mergeTwoLists($l1,$l2->next);
            return $l2;
        }
    }   
}