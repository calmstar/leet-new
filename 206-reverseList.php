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
     * 从后往前处理
     * 类似后序遍历，递归到尾部，才开始处理翻转
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


    /**
     * 迭代法
     * 从前往后处理
     * @param $head
     * @return mixed
     */
    function reverseListInteration ($head)
    {
        // 只有1个节点或0个节点时，直接返回，不需翻转
        if ($head === null || $head->next === null) return $head;

        // 按顺序标注三个点
        $currNode = $head;
        $nextNode = $currNode->next;
        $next2Node = $currNode->next->next;
        $currNode->next = null; // 现将首节点置为null

        while ($nextNode !== null) { // 如果第二个节点不为空，就还需要翻转。
            $nextNode->next = $currNode; // 将指向进行翻转

            // 将三个节点往前推进一步
            $currNode = $nextNode;
            $nextNode = $next2Node;
            $next2Node = $next2Node->next;
        }

        return $currNode;
    }

}