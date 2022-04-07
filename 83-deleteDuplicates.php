<?php
/**
 * https://mp.weixin.qq.com/s/Z-oYzx9O1pjiym6HtKqGIQ
 *
 * 存在一个按升序排列的链表，给你这个链表的头节点 head ，请你删除所有重复的元素，使每个元素 只出现一次 。
返回同样按升序排列的结果链表。
 * 输入：head = [1,1,2]
    输出：[1,2]
 *
 * 直接想出来的方法
 * @param $head
 * @return mixed
 */
function deleteDuplicates($head)
{
    if (empty($head)) return $head;

    $curr = $head;
    while ($curr && $curr->next) {
        if ($curr->val == $curr->next->val) {
            $curr->next = $curr->next->next;
        } else {
            $curr = $curr->next;
        }
    }
    return $head;
}

/**
 * 快慢指针思想，0-slow区间的为维护的不重复元素，通过交换元素在原地实现方法
 * https://mp.weixin.qq.com/s/55UPwGL0-Vgdh8wUEPXpMQ
 * 类似 /Users/starc/code/leet-new/26-removeDuplicates.php
 */
function deleteDuplicatesV2($head)
{
    if ($head === null) return null;
    $slow = $head;
    $fast = $head;
    while ($fast !== null) {
        if ($fast->val != $slow->val) {
            // 慢指针串起
            $slow->next = $fast;
            $slow = $slow->next;
        }
        $fast = $fast->next;
    }
    $slow->next = null;
    return $head;
}