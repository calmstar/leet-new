package main

/**
给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串 s ，判断字符串是否有效。

有效字符串需满足：

左括号必须用相同类型的右括号闭合。
左括号必须以正确的顺序闭合。
*/

func isValid(s string) bool {
	sLen := len(s) // 字符串的本质是byte类型的数组。 byte=uint8，可以和ascii码保持对应，底层存的是数字，展示成英文字符需要转成string类型或%c方式进行输出
	if sLen%2 == 1 {
		return false
	}
	strMap := map[byte]byte{
		'}': '{',
		')': '(',
		']': '[',
	}
	var stack []byte // 可利用切片进行模拟队列和栈
	for i := 0; i < sLen; i++ {
		if _, ok := strMap[s[i]]; ok {
			if len(stack) <= 0 {
				return false
			}
			// 存在-出栈进行匹配
			pair := stack[len(stack)-1]
			stack = stack[:len(stack)-1] // 出栈
			if pair != strMap[s[i]] {
				return false
			}
		} else {
			// 不存在-入栈
			stack = append(stack, s[i])
		}
	}
	if len(stack) == 0 {
		return true
	} else {
		return false
	}
}

// 使用字符串，使用内存占用更多
func isValidV2(s string) bool {
	sLen := len(s) // 字符串的本质是byte类型的数组。 byte=uint8，可以和ascii码保持对应，底层存的是数字，展示成英文字符需要转成string类型或%c方式进行输出
	if sLen%2 == 1 {
		return false
	}
	// 换成使用string
	strMap := map[string]string{
		"}": "{",
		")": "(",
		"]": "[",
	}
	var stack []string // 可利用切片进行模拟队列和栈
	for i := 0; i < sLen; i++ {
		tempS := string(s[i])
		if _, ok := strMap[tempS]; ok {
			if len(stack) <= 0 {
				return false
			}
			// 存在-出栈进行匹配
			pair := stack[len(stack)-1]
			stack = stack[:len(stack)-1] // 出栈
			if pair != strMap[tempS] {
				return false
			}
		} else {
			// 不存在-入栈
			stack = append(stack, tempS)
		}
	}
	if len(stack) == 0 {
		return true
	} else {
		return false
	}
}

func main() {
	isValid("avs")
}
