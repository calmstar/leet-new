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
     * 给你一个链表数组，每个链表都已经按升序排列。

    请你将所有链表合并到一个升序链表中，返回合并后的链表。

     

    示例 1：

    输入：lists = [[1,4,5],[1,3,4],[2,6]]
    输出：[1,1,2,3,4,4,5,6]
    解释：链表数组如下：
    [
    1->4->5,
    1->3->4,
    2->6
    ]
    将它们合并到一个有序链表中得到。
    1->1->2->3->4->4->5->6

    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/merge-k-sorted-lists
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     */
    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists($lists) {
        $dummy = new ListNode(0);
        $p = $dummy;

        // 优先队列存入k个链表的头结点
        $minHeap = new MyMinHeap();
        $num = count($lists);
        for ($i = 0; $i < $num; $i++) {
            if ($lists[$i] !== null) {
                $minHeap->insert($lists[$i]);
            }
        }
        while (!$minHeap->isEmpty()) {
            $tempNode = $minHeap->extract();
            $p->next = $tempNode;
            if ($tempNode->next !== null) {
                $minHeap->insert($tempNode->next);
            }
            $p = $p->next;
        }
        return $dummy->next;
    }

    function test ()
    {
        $arr = [1,5,3,2];
        $minHeap = new MyMinHeap();
        foreach ($arr as $item) {
            $minHeap->insert($item);
        }
        $res = [];
        while (count($res) < 4) {
            $res[] = $minHeap->extract();
        }
        return $res;
    }

}

class MyMinHeap extends SplHeap {
    function compare($value1, $value2)
    {
        // 最小堆
        return $value2->val - $value1->val;
        // 最大堆
//        return $value1 - $value2;
    }
}

$res = (new Solution())->test();
var_dump($res);