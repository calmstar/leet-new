<?php

class ListNode {
      public $val = 0;
      public $next = null;
      function __construct($val = 0, $next = null) {
          $this->val = $val;
          $this->next = $next;
      }
}

// 迭代法
function mergeTwoLists ($l1, $l2)
{
    if (!$l1 && !$l2) return null;
    $res = new ListNode();
    $curr = $res; // 当前指针，用来进行偏移

    while ($l1 || $l2) {
        // 如果两个链表都有值
        if (!empty($l1) && !empty($l2)) {
            if ($l1->val < $l2->val) {
                $curr->next = new ListNode($l1->val);
                $l1 = $l1->next;
            } else {
                $curr->next = new ListNode($l2->val);
                $l2 = $l2->next;
            }
            // 执行完要移动当前指针，然后continue不往下执行，否则对后面会有影响
            $curr = $curr->next;
            continue;
        }

        // 如果一个有值，一个没值
        if (empty($l1) && !empty($l2)) {
            $curr->next = new ListNode($l2->val);
            $l2 = $l2->next;
            $curr = $curr->next;
            continue;
        }

        if (!empty($l1) && empty($l2)) {
            $curr->next = new ListNode($l1->val);
            $l1 = $l1->next;
            $curr = $curr->next;
            continue;
        }
    }

    return $res->next;
}

// 优化迭代法
// 时间和空间复杂度都是 O n
function mergeTwoLists11 ($l1, $l2) {
    if (!$l1 && !$l2) return null;

    $res = new ListNode();
    $curr = $res; // 当前指针，用来进行偏移

    // 如果两个链表都不为空，则开始判断
    while ($l1 && $l2) {
        if ($l1->val < $l2->val) {
            $curr->next = $l1;
            $l1 = $l1->next;
        } else {
            $curr->next = $l2;
            $l2 = $l2->next;
        }
        $curr = $curr->next;
    }
    // 如果其中一个链表空了，那么直接取不为空的链表补在后面就行了
    $curr->next = $l1 ?? $l2;
    return $res->next;
}


// 递归法
// 空间复杂度 :  单次执行的空间 * 递归次数 = 1 * n = O(n)
// 时间复杂度 ： 单次执行的时间 * 递归次数 = 1 * n = O(n)
function mergeTwoLists2 ($l1, $l2)
{
    if (!$l1 || !$l2)  return $l1 ?? $l2;

    // 下面需要自己画图才能理解到位
    if ($l1->val < $l2->val) {
        $l1->next = mergeTwoLists2($l1->next, $l2);
        return $l1;
    } else {
        $l2->next = mergeTwoLists2($l1, $l2->next);
        return $l2;
    }
}
