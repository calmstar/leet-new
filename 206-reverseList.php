<?php
require_once 'tools.php';
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
     * 类似后序遍历，递归到尾部，才开始处理翻转 -- 后序遍历
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

    // 迭代法
    function practice ($head)
    {
        if ($head->next === null || $head === null) return $head;

        $prev = null;
        $curr = $head;
        while ($curr !== null) {
            $temp = $curr->next;
            $curr->next = $prev;

            $prev = $curr;
            $curr = $temp;
        }
        return $prev;
    }

    // ------------- 反转链表 ------------

    // 翻转链表的前n个节点
    private $num = 0; // 当前遍历的节点个数
    private $after = null; // n+1个节点，用来根旧的头节点衔接
    function reverseNMy ($root, $n)
    {
        if ($root === null) return null;
        if ($n == 1) return $root;
        $this->num++;
        if ($this->num == $n) {
            // 到达了前n个节点
            $this->after = $root->next;
            return $root;
        }
        $newNode = $this->reverseNMy($root->next, $n);
        $this->num--;
        $root->next->next = $root;
//        if ($this->num == 1) { // 可模拟下，确实是为1的时候
//            $root->next = $this->after;
//        } else {
//            $root->next = null;
//        }
        // 直接让其一直指向 $this->after 也可
        $root->next = $this->after;
        return $newNode;
    }

    // 反转链表m-n部分的的链表 -- 意思跟前面的反转前n个链表的很接近
    function reverseBetweenMy ($root, $m, $n)
    {
        if ($root === null) return null;
        if ($m == 1) {
            return $this->reverseNMy($root, $n-$m+1);
        } else {
            $curr = $root;
            $mTmp = $m;
            while ($mTmp !== 2) {
                // 需为目标$m节点的前一个
                $curr = $curr->next;
                $mTmp--;
            }
            $tmp = $curr->next;
            $curr->next = $this->reverseNMy($tmp, $n-$m+1);
            return $root;
        }
    }

}
$root = buildListNode([1,2,3]);
$res = (new Solution())->reverseBetweenMy($root, 3,3);
print_r($res);

