package main

/**
 * Definition for singly-linked list.
 * type ListNode struct {
 *     Val int
 *     Next *ListNode
 * }
 */
func mergeTwoLists(list1 *ListNode, list2 *ListNode) *ListNode {
	dummy1 := &ListNode{}
	dummy2 := &ListNode{}
	dummyRes := &ListNode{}
	res := dummyRes

	dummy1.Next = list1
	dummy2.Next = list2

	for dummy1.Next != nil && dummy2.Next != nil {
		if dummy1.Next.Val < dummy2.Next.Val {
			dummyRes.Next = &ListNode{Val: dummy1.Next.Val}
			dummy1 = dummy1.Next
		} else {
			dummyRes.Next = &ListNode{Val: dummy2.Next.Val}
			dummy2 = dummy2.Next
		}
		dummyRes = dummyRes.Next
	}

	if dummy1.Next != nil {
		dummyRes.Next = dummy1.Next
	}
	if dummy2.Next != nil {
		dummyRes.Next = dummy2.Next
	}
	return res.Next
}

func mergeTwoListsV2(list1 *ListNode, list2 *ListNode) *ListNode {
	if list1 == nil && list2 == nil {
		return nil
	}
	res := &ListNode{}
	curr := res
	for list1 != nil && list2 != nil {
		if list1.Val < list2.Val {
			curr.Next = list1
			list1 = list1.Next
		} else {
			curr.Next = list2
			list2 = list2.Next
		}
		curr = curr.Next
	}
	if list1 != nil {
		curr.Next = list1
	}
	if list2 != nil {
		curr.Next = list2
	}

	return res.Next
}
