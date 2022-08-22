package main

import (
	"sort"
	"strconv"
)

// 暴力法，超时但正确
func threeSum(nums []int) [][]int {
	var res [][]int
	existMap := make(map[string]bool)
	numCount := len(nums)
	for i := 0; i < numCount-2; i++ {
		for j := i + 1; j < numCount-1; j++ {
			for k := j + 1; k < numCount; k++ {
				if nums[i]+nums[j]+nums[k] == 0 {
					tempRes := []int{nums[i], nums[j], nums[k]}
					sort.Ints(tempRes)
					tempKey := strconv.Itoa(tempRes[0]) + strconv.Itoa(tempRes[1]) + strconv.Itoa(tempRes[2])
					//tempKey := strings.Join(tempRes, ",") // 需要字符串类型切片
					if _, ok := existMap[tempKey]; ok {
						continue
					}
					// 排序做成唯一key，防止重复放入
					res = append(res, tempRes)
					existMap[tempKey] = true
				}
			}
		}
	}
	return res
}
