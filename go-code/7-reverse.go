package main

import (
	"fmt"
	"math"
)

/**
输入：x = 123
输出：321
*/
func reverse(x int) int {
	var rev int
	for x != 0 {
		if rev < math.MinInt32/10 || rev > math.MaxInt32/10 {
			return 0
		}
		digit := x % 10
		x /= 10
		rev = rev*10 + digit
	}
	return rev
}

func main() {
	res := reverse(89)
	fmt.Println(res)
}
