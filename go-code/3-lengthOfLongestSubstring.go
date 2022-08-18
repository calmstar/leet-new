package main

import "fmt"

/**
* 无重复的最长字串
* 输入: s = "abcabcbb"
   输出: 3
   解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
*/
func lengthOfLongestSubstring(s string) int {
	sLen := len(s)
	if sLen < 2 {
		return sLen
	}
	res, left, right := 0, 0, 0
	window := make(map[string]int)

	for right < sLen {
		rTemp := string(s[right])
		window[rTemp]++
		right++

		for window[rTemp] > 1 {
			lTemp := string(s[left])
			window[lTemp]--
			left++
		}
		if res < (right - left) {
			res = right - left
		}
	}
	return res
}

func main() {
	a := "abcac"
	res := lengthOfLongestSubstring(a)
	fmt.Println(res)
}
