package main

import (
	"fmt"
)

var res [][]int = make([][]int, 0)

func permute(nums []int) [][]int {
	var backtrack []int
	backtracking(backtrack, nums)
	return res
}

func backtracking(backtrack []int, nums []int) {
	if len(backtrack) == len(nums) {
		res = append(res, backtrack)
		return
	}
	for _, v := range nums {
		if InSlice(v, backtrack) {
			continue
		}

		backtrack = append(backtrack, v) // 入栈
		backtracking(backtrack, nums)
		backtrack = backtrack[0 : len(backtrack)-1]
	}
}
func InSlice(val int, slice []int) bool {
	for _, v := range slice {
		if v == val {
			return true
		}
	}
	return false
}

func main() {
	nums := []int{1, 2, 3}
	//res := permute(nums)
	//res := permuteV2(nums)
	res := permuteV3(nums)
	fmt.Println(res)
}

// --------------v3----------------------
// 跟v1比较，就是 res 换成了指针类型传入。 slice虽然本身是引用类型，变量本身存的是值的地址，但是由于append扩容导致地址失效，所以采用指针（即变量值地址的值的地址）
func permuteV3(nums []int) [][]int {
	var res [][]int = make([][]int, 0)
	var backtrack []int
	backtrackingV3(&res, backtrack, nums)
	return res
}

func backtrackingV3(res *[][]int, backtrack []int, nums []int) {
	if len(backtrack) == len(nums) {
		*res = append(*res, backtrack)
		return
	}
	for _, v := range nums {
		if InSlice(v, backtrack) {
			continue
		}

		backtrack = append(backtrack, v) // 入栈
		backtrackingV3(res, backtrack, nums)
		backtrack = backtrack[0 : len(backtrack)-1]
	}
}

// ----------------v2--------------------
func permuteV2(nums []int) [][]int {
	// 回溯
	res := [][]int{}
	var backTrack func(path []int, start int)

	backTrack = func(path []int, start int) {
		if len(path) == len(nums) {
			// 把path添加到reszhong
			tmp := make([]int, len(path))
			copy(tmp, path)
			res = append(res, tmp)
			return
		}

		for i := start; i < len(nums); i++ {
			// 如果当前路径包含相同字母，不添加
			flag := false
			for _, v := range path {
				if v == nums[i] {
					flag = true
					break
				}
			}
			if flag {
				continue
			}

			path = append(path, nums[i])
			backTrack(path, start)
			path = path[:len(path)-1]
		}
	}

	backTrack([]int{}, 0)
	return res
}
