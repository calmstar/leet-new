package main

/**
 * Definition for singly-linked list.
 * type ListNode struct {
 *     Val int
 *     Next *ListNode
 * }
 */

func addTwoNumbers(l1 *ListNode, l2 *ListNode) *ListNode {
	res := l1
	addFlag := 0
	sum := 0
	for l1 != nil && l2 != nil {
		sum = l1.Val + l2.Val + addFlag
		if sum > 9 {
			addFlag = 1
		} else {
			addFlag = 0
		}
		l1.Val = sum % 10

		if l1.Next == nil || l2.Next == nil {
			break
		}
		l1 = l1.Next
		l2 = l2.Next
	}
	if l1.Next == nil && l2.Next != nil {
		l2 = l2.Next
		for l2 != nil {
			if addFlag == 0 {
				l1.Next = l2
				break
			} else {
				sum = l2.Val + addFlag
				if sum > 9 {
					addFlag = 1
				} else {
					addFlag = 0
				}
				val := sum % 10

				l1.Next = &ListNode{
					Val:  val,
					Next: nil,
				}
				l1 = l1.Next
				l2 = l2.Next
			}
		}
	}

	if l1.Next != nil && l2.Next == nil {
		l1 = l1.Next
		for l1 != nil && addFlag == 1 {
			sum = l1.Val + addFlag
			if sum > 9 {
				addFlag = 1
			} else {
				addFlag = 0
			}
			val := sum % 10

			l1.Val = val
			if l1.Next == nil {
				break
			}
			l1 = l1.Next
		}
	}

	if addFlag == 1 {
		l1.Next = &ListNode{
			Val:  addFlag,
			Next: nil,
		}
	}

	return res
}
