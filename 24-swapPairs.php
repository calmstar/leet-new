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
function  swapPairs ($head)
{
    // 定义结果链表指针 $res
    $res = new ListNode();
    $res->next = $head;
    $curr = $res; // 当前指针用来做偏移

    // 需要画图理解下面
    while ($curr->next && $curr->next->next) {
        $a = $curr->next;
        $b = $curr->next->next;

        // 交换指向
        $a->next = $a->next->next;
        $b->next = $a;
        $curr->next = $b;

        $a = $a->next;
        $b = $a->next->next;
        $curr = $curr->next->next;
    }
    return $res->next;
}


// 递归法
function  swapPairs2 ($head)
{
    if (!$head || !$head->next) return $head;

    $res = new ListNode();
    $res->next = $head;
    $curr = $res;

    $a = $curr->next;
    $b = $curr->next->next;
    // 进行交换
    $a->next = swapPairs2($a->next->next);
    $b->next = $a;
    $res->next = $b; // 记得连接回去

    return $res->next;
}



