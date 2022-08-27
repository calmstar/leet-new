package main

/**
删除有序数组中的重复项
 *
 * 输入：nums = [1,1,2]
输出：2, nums = [1,2]
解释：函数应该返回新的长度 2 ，并且原数组 nums 的前两个元素被修改为 1, 2 。不需要考虑数组中超出新长度后面的元素。
*/

// 维护[0, slow]为不重复数字区间
func removeDuplicates(nums []int) int {
	nLen := len(nums)
	slow, fast := 0, 0
	for fast < nLen {
		if nums[fast] != nums[slow] {
			slow++
			nums[slow] = nums[fast]
		}
		fast++
	}
	return slow + 1
}
