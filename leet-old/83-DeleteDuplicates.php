<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/24
 * Time: 19:38
 */

/**
 * 给定一个排序链表，删除所有重复的元素，使得每个元素只出现一次。

示例 1:

输入: 1->1->2
输出: 1->2
示例 2:

输入: 1->1->2->3->3
输出: 1->2->3

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/remove-duplicates-from-sorted-list
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val) { $this->val = $val; }
}

class Solution {

    /**
     * 1 用php独有的哈希数组存储以前出现的数字，并判断是否从链表移除
    2 元素重复就移除：让当前节点的下一个节点直接指向下下一个节点。
    3 元素不重复不移除， 并让指针指向下一个节点
     * @param ListNode $head
     * @return ListNode
     */
    function deleteDuplicates($head) {
        $hashArr = [];
        $val = $head->val;
        $hashArr[$val] = 1;
        $temp = $head;
        while (isset($temp->next) && !empty($temp->next)) { // 1-2
            $val = $temp->next->val;
            if (isset($hashArr[$val])) {
                // 元素重复的情况
                $temp->next = $temp->next->next; // 不用偏移
            } else {
                // 元素不重复的情况
                $hashArr[$val] = 1;
                $temp = $temp->next;
            }
        }
//        return $temp; 会错误
        return $head; // 正确？为啥 $head 就可以
    }


    /**
     * @param $head
     * @return mixed
     */
    function deleteDuplicatesV2($head) {
        $curr = $head;
        while($curr!=null && $curr->next!=null){
            if($curr->val==$curr->next->val){ // 因为是排序链表，所以可以这样
                $curr->next = $curr->next->next;
            }else{
                $curr = $curr->next;
            }
        }
        return $head;
    }


}
$head = new ListNode(1);
$listNode2 = new ListNode(1);
$listNode3 = new ListNode(2);
$head->next = $listNode2;
$listNode2->next = $listNode3;
$s = new Solution();
echo "----v1---- \n";
var_dump($s->deleteDuplicates($head));
echo "----v2---- \n";
var_dump($s->deleteDuplicatesV2($head));