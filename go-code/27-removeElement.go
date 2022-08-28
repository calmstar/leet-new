package main

/***
输入：nums = [3,2,2,3], val = 3
输出：2, nums = [2,2]
*/

// 维护[0,slow]为符合条件的区间
func removeElement(nums []int, val int) int {
	fast, slow := 0, 0
	nLen := len(nums)

	for i := 0; i < nLen; i++ {
		if nums[fast] != val {
			nums[slow] = nums[fast]
			slow++
		}
		fast++
	}
	return slow
}
