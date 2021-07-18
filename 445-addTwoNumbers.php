<?php
  class ListNode {
      public $val = 0;
      public $next = null;
      function __construct($val = 0, $next = null) {
          $this->val = $val;
          $this->next = $next;
      }
  }
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        if (empty($l1) && empty($l2)) return null;
        $stack1 = [];
        $stack2 = [];
        $head = null;
        while ($l1 !== null || $l2 !== null) {
            if ($l1 !== null) {
                array_push($stack1, $l1->val);
                $l1 = $l1->next;
            }
            if ($l2 !== null) {
                array_push($stack2, $l2->val);
                $l2 = $l2->next;
            }
        }
        $carry = 0;
        while ($stack1 || $stack2 || $carry) {
            $res = 0;
            $num1 = 0;
            $num2 = 0;
            if (!empty($stack1)) {
                $num1 = array_pop($stack1);
            }
            if (!empty($stack2)) {
                $num2 = array_pop($stack2);
            }
            $res = $num1 + $num2 + $carry;
            $carry = floor($res / 10); // 取进位
            $res = $res % 10; // 取余数

            if (!empty($head)) {
                $tmp = new ListNode($res);
                $tmp->next = $head;
                $head = $tmp;
            } else {
                $head = new ListNode($res);
            }
        }
        return $head;
    }
}