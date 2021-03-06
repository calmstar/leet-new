<?php
class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val = 0, $next = null) {
         $this->val = $val;
         $this->next = $next;
     }
}

/**
 * for循环法
 * @param $l1
 * @param $l2
 * @return mixed
 */
function addTwoNumbers ($l1, $l2)
{
    // 使用$l1作为结果链表，$res记录指向链表的开始地方，防止开始指针丢失
    $res = $l1;
    $addFlag = 0; // 进位标志
    $sum = 0;
    while ($l1 != null && $l2 != null) {
        $sum = $l1->val + $l2->val + $addFlag;
        $addFlag = floor($sum / 10);
        $l1->val = $sum % 10;

        // 防止指针走空
        if (empty($l1->next) || empty($l2->next)) break;
        $l1 = $l1->next;
        $l2 = $l2->next;
    }

    if ($l1->next == null && $l2->next != null) {
        $l2 = $l2->next; // $l2在上面已经计算过，所以指向next先再处理
        while ($l2) {
            if ($addFlag == 0) {
                // 如果没有进位了，则直接把l2链表后的元素补到l1即可
                $l1->next = $l2;
                break;
            } else {
                $sum = $l2->val + $addFlag;
                $addFlag = floor($sum / 10 ) ;
                $val = $sum % 10;
                var_dump($val);

                // 构造新的链表节点挂到 l1 上
                $l1->next = new ListNode($val);
                $l1 = $l1->next;
                $l2 = $l2->next;

            }
        }
    }
    if ($l1->next != null && $l2->next == null) {
        $l1 = $l1->next;
        while($l1 && $addFlag == 1) {
            $sum = $l1->val + $addFlag;
            $addFlag = floor($sum / 10);
            $val = $sum % 10;
            $l1->val = $val;
            // 防止指向为空
            if (empty($l1->next)) break;
            $l1 = $l1->next;
        }
    }
    if ($addFlag == 1) {
        $l1->next = new ListNode(1);
    }

    return $res;
}

// 递归方法
function addTwoNumbers2 ($l1, $l2)
{
    if (empty($l1) && empty($l2)) return;

    $total = $l1->val + $l2->val;
    $addFlag = floor($total / 10); // 进位标志
    $val = $total % 10;
    $res = new ListNode($val); // 构造节点

    // 特殊情况，补充节点，对齐数量
    if (empty($l1->next) && !empty($l2->next)) {
        $l1->next = new ListNode(0);
    }
    if (!empty($l1->next) && empty($l2->next)) {
        $l2->next = new ListNode(0);
    }
    if (empty($l1->next) && empty($l2->next) && $addFlag) {
        // 进位标志为1时，也要补充节点
        $l1->next = new ListNode(0);
        $l2->next = new ListNode(0);
    }
    if ($l1->next && $l2->next && $addFlag) {
        $l1->next->val = $l1->next->val + $addFlag;
    }

    // 当两个链表为空，且进位标志为0时，就不用为链表加节点。从而会导致下个节点为空，则为递归出口
    $res->next = addTwoNumbers2($l1->next, $l2->next);
    return $res;
}
