package main

import (
	"bytes"
	"fmt"
	"leet-new/go/lodago"
	"runtime"
	"strconv"
	"unsafe"
)

func main() {
	hhh()

}

func xx() {
	//slice := make([]int, 0, 4)
	//slice = append(slice, 1, 2, 3)
	//TestSlice(slice)
	//fmt.Println(slice)
	buf := make([]byte, 4096)
	n := runtime.Stack(buf, false)
	fmt.Println("aa")
	fmt.Println(string(buf[:n]))
}

func hhh() {
	xx()
}

func TestSlice(slice []int) {
	slice = append(slice, 4)
	slice[0] = 10
	//testByteBuffer()
	hh()
}

func hh() {
	a := []interface{}{1, 2, 3}
	aa := 1
	fmt.Println(lodago.In_slice(aa, a))
}

func testV1() {
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

func testByteBuffer() {
	buf1 := bytes.NewBufferString("hello")
	//fmt.Println(buf1)
	//fmt.Printf("%T", buf1)

	s1 := " world"
	buf1.WriteString(s1)
	fmt.Println(buf1)

	s2 := []byte(" hhhh")
	buf1.Write(s2)
	fmt.Println(buf1)

	var s3 byte = '~'
	//s33 := 'a' //自动推导方式。为了兼容utf8类型，存字符直接使用了rune(int32)类型，实际对于英文字母和普通符号，使用byte(uint8)存储就够了
	buf1.WriteByte(s3)
	fmt.Println(buf1)

	var s4 rune = '我'
	buf1.WriteRune(s4)
	fmt.Println(buf1.String())

	// 证明本机电脑是 64 位
	a := 3
	fmt.Printf("hh --%d --", unsafe.Sizeof(a)) // 输出8
	fmt.Println(runtime.GOARCH)
}

type data struct {
	name string
}

type printer interface {
	print()
}

//func (p *data) print() { // 带指针类型，实现interface会报错
//	fmt.Println("name: ", p.name)
//}

func (p data) print() {
	fmt.Println("name: ", p.name)
}

func printTest() {
	d1 := data{"one"}
	d1.print() // d1 变量可寻址，可直接调用指针 receiver 的方法

	var in printer = data{"two"}
	in.print() // 类型不匹配
}
