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
     * https://blog.csdn.net/fx677588/article/details/72357389
     * https://mp.weixin.qq.com/s/5wz_YJ3lTkDH3nWfVDi5SA
     *
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        if ($head->next === null) return $head;
        $last = $this->reverseList($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $last;
    }
}