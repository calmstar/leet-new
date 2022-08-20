package main

import "fmt"

// 最长回文子串
/**
 * 输入：s = "babad"
输出："bab"
解释："aba" 同样是符合题意的答案。
*/

// 中心扩展法
func longestPalindrome(s string) string {
	sLen := len(s)
	maxStr := ""
	for i := 0; i < sLen; i++ {
		s1 := isPalindrome(i, i, s)
		s2 := isPalindrome(i, i+1, s)
		if len(s1) > len(s2) && len(s1) > len(maxStr) {
			maxStr = s1
		}
		if len(s2) > len(s1) && len(s2) > len(maxStr) {
			maxStr = s2
		}
	}
	return maxStr
}

func isPalindrome(l int, r int, s string) string {
	sLen := len(s)
	resStr := ""
	for l >= 0 && r <= sLen-1 {
		if s[l] == s[r] {
			if l == r {
				resStr += string(s[l])
			} else {
				resStr = string(s[l]) + resStr + string(s[r])
			}
			l--
			r++
		} else {
			return resStr
		}
	}
	return resStr
}

func main() {
	res := longestPalindrome("babad")
	fmt.Println(res)
}
