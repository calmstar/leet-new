package main

import "fmt"

/**
示例 1：

输入：nums = [2,7,11,15], target = 9
输出：[0,1]
解释：因为 nums[0] + nums[1] == 9 ，返回 [0, 1] 。

来源：力扣（LeetCode）
链接：https://leetcode.cn/problems/two-sum
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
*/

func twoSum(nums []int, target int) []int {
	targetIndex := make([]int, 2)
	length := len(nums)
	flag := false

	for i := 0; i < length; i++ {
		restTarget := target - nums[i]
		targetIndex[0] = i
		for j := i + 1; j < length; j++ {
			if restTarget == nums[j] {
				flag = true
				targetIndex[1] = j
			}
		}
		if flag {
			return targetIndex
		}
	}
	return targetIndex
}

func twoSumV2(nums []int, target int) []int {
	length := len(nums)
	for i := 0; i < length; i++ {
		for j := i + 1; j < length; j++ {
			if nums[i]+nums[j] == target {
				return []int{i, j}
			}
		}
	}
	return nil
}

func main() {
	nums := []int{3, 2, 4}
	target := 6
	//res := twoSum(nums, target)
	res := twoSumV2(nums, target)
	fmt.Println(res)
}
