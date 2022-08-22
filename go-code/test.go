package main

import (
	"fmt"
	"strconv"
)

func main() {
	test()
}

func test() {
	//str := "aa中生cc"
	////str := "abcde"
	//strRune := []rune(str)
	//for _, v := range strRune {
	//	fmt.Printf(" %c", v)
	//}
	//
	//var a byte = 'A'
	//var b uint8 = 'B'
	//fmt.Printf("a 的值: %v \nb 的值: %v", a, b)
	//fmt.Println()
	//fmt.Println(a, b)

	var c rune = 'a'
	var i int = 98
	i1 := int(c)
	fmt.Println("'a' convert to", i1)
	c1 := rune(i)
	fmt.Println("98 convert to", string(c1)) // string转换会把数字转成对应的ascii字符
	s := strconv.Itoa(i)                     //s := string(10) 直接转换会变成ascii字符 "\n"
	fmt.Println(s)
	//string to rune
	for _, char := range []rune("世界你好") {
		fmt.Println(string(char))
	}
	// -----
	// rune、byte等实际是整型，必需先将其转换为string才能打印出来，否则打印出来的是一个整数
	// go中没有字符型，都是用ascii对应的数字来代表
	cc := 'a'
	fmt.Println(cc)
	fmt.Println(string(cc))
	fmt.Println(string(97))
}