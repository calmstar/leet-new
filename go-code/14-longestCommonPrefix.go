package main

import "fmt"

/**
 最长公共前缀
输入：strs = ["flower","flow","flight"]
输出："fl"
*/
func longestCommonPrefix(strs []string) string {
	if len(strs) == 0 {
		return ""
	}
	res := ""
	i := 0
	sLen := len(strs)
	s1Len := len(strs[0])
	for {
		if s1Len <= i {
			break
		}
		tempChar := strs[0][i]
		jump := false
		for j := 1; j < sLen; j++ {
			if len(strs[j]) <= i {
				jump = true
				break
			}
			if tempChar != strs[j][i] {
				jump = true
				break
			}
		}
		if jump {
			break
		}
		res += string(tempChar)
		i++
	}
	return res
}

func main() {
	aa := []string{"flower", "flow", "flight"}
	res := longestCommonPrefix(aa)
	fmt.Println(res)

}
