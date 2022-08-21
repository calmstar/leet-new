package main

import (
	"fmt"
	"strconv"
)

func isPalindrome(x int) bool {
	//s := string(x) 直接转换会有问题
	s := strconv.Itoa(x)
	sLen := len(s)
	for i := 0; i < sLen; i++ {
		lastIndex := sLen - i - 1
		if s[i] != s[lastIndex] {
			return false
		}
	}
	return true
}

func main() {
	a := 10
	res := isPalindrome(a)
	fmt.Println(res)
}
