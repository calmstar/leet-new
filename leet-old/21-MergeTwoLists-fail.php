<?php
 
  class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
  }
 
class Solution {

	private $l3 = null;

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2) {
        if (empty($this->l3)) {
            $this->l3 = new ListNode(0);
        }

        if ($l1 == null && $l2 == null) return $this->l3;
        
        if ($l1 == null && $l2 != null) {
            $this->l3->val = $l2->val;
            $this->l3->next = $l2->next;
            return $this->l3;
        } 

        if ($l1 != null && $l2 == null) {
            $this->l3->val = $l1->val;
            $this->l3->next = $l1->next;
            return $this->l3;
        } 

        if ($l1->val > $l2->val) {
            $this->l3->val = $l2->val;
            $this->l3->next = $this->mergeTwoLists($l2->next, $l1);
        } else {
            $this->l3->val = $l1->val;
            $this->l3->next = $this->mergeTwoLists($l1->next, $l2);
        }

    }
}

$node1 = new ListNode(1);
$node2 = new ListNode(2);
$node3 = new ListNode(3);
$node4 = new ListNode(4);
$node5 = new ListNode(5);
$node6 = new ListNode(6);

$node1->next = $node2;
$node2->next = $node3;
$l1 = $node1;

$node4->next = $node5;
$node5->next = $node6;
$l2 = $node4;

$s = new Solution();
var_dump('xxx', $s->mergeTwoLists($l1, $l2));