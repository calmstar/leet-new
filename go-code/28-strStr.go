package main

import "fmt"

/**
给你两个字符串haystack 和 needle ，
请你在 haystack 字符串中找出 needle 字符串出现的第一个位置（下标从 0 开始）。如果不存在，则返回-1 。

"hello"
"ll"
返回2
*/
func strStr(haystack string, needle string) int {
	sLen := len(haystack)
	nLen := len(needle)
	if nLen == 0 {
		return -1
	}
	if nLen > sLen {
		return -1
	}
	for i := 0; i < sLen; i++ {
		match := true
		k := i
		if i > sLen-nLen { //防止数组越界
			break
		}
		for j := 0; j < nLen; j++ {
			if needle[j] == haystack[k] {
				k++
				continue
			} else {
				match = false
				break
			}
		}
		if match {
			return i
		}
	}
	return -1
}

func main() {
	a := "mississippi"
	b := "issipi"
	res := strStr(a, b)
	fmt.Println(res)
}
