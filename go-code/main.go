package main

import (
	"bytes"
	"fmt"
	"leet-new/go/lodago"
	"log"
	"math/rand"
	"runtime"
	"strconv"
	"sync"
	"testing"
	"time"
	"unsafe"
)

func init() {
	// 获取日志文件句柄
	// 以 只写入文件|没有时创建|文件尾部追加 的形式打开这个文件
	//logFile, err := os.OpenFile(`./日志文件.log`, os.O_WRONLY|os.O_CREATE|os.O_APPEND, 0666)
	//if err != nil {
	//	panic(err)
	//}
	//// 设置存储位置, log. 就会输出到指定的文件位置
	//log.SetOutput(logFile)

}

func main() {
	//testConcurrentMap()
	//testConcurrentSafeMap()
}

// -------- 性能陷阱 start ---------
func lastNumsBySlice(origin []int) []int {
	return origin[len(origin)-2:]
}

func lastNumsByCopy(origin []int) []int {
	result := make([]int, 2)
	copy(result, origin[len(origin)-2:])
	return result
}

func generateWithCap(n int) []int {
	rand.Seed(time.Now().UnixNano())
	nums := make([]int, 0, n)
	for i := 0; i < n; i++ {
		nums = append(nums, rand.Int())
	}
	return nums
}

func printMem(t *testing.T) {
	t.Helper()
	var rtm runtime.MemStats
	runtime.ReadMemStats(&rtm)
	t.Logf("%.2f MB", float64(rtm.Alloc)/1024./1024.)
}

func testLastChars(t *testing.T, f func([]int) []int) {
	t.Helper()
	ans := make([][]int, 0)
	for k := 0; k < 100; k++ {
		origin := generateWithCap(128 * 1024) // 1M
		ans = append(ans, f(origin))
	}
	printMem(t)
	_ = ans
}

func TestLastCharsBySlice(t *testing.T) { testLastChars(t, lastNumsBySlice) }
func TestLastCharsByCopy(t *testing.T)  { testLastChars(t, lastNumsByCopy) }

// -------- 性能陷阱 end -----------

// -------- 并发写入map问题 -----------
func testConcurrentMap() {
	m := make(map[int]int)

	for i := 0; i < 100; i++ {
		go func() {
			if err := recover(); err != nil {
				log.Fatalf("err: %v", err)
			}
			m[i] = 10
		}()
	}
	time.Sleep(time.Second)
	fmt.Println(m)
}

func testConcurrentSafeMap() {
	m := &SMap{
		testMap: make(map[int]int),
	}
	for i := 0; i < 100; i++ {
		go func(i int) {
			if err := recover(); err != nil {
				log.Fatalf("err: %v", err)
			}
			m.writeMap(i, i)
			log.Println(m.readMap(i))
		}(i)
	}
	time.Sleep(time.Second)
	//fmt.Println(mMap)
}

var mMap *SMap

type SMap struct {
	testMap map[int]int
	sync.RWMutex
}

func (l *SMap) readMap(key int) int {
	l.RLock()
	res := l.testMap[key]
	l.RUnlock()
	return res
}
func (l *SMap) writeMap(key int, value int) bool {
	l.Lock()
	l.testMap[key] = value
	l.Unlock()
	return true
}

// -------- 并发写入map问题 -----------

func panicCross() {
	go func() {
		defer func() {
			if err := recover(); err != nil {
				log.Fatalf("hh-test： %v", err)
			}
		}()
		handle()
	}()
}

// 跨协程的恐慌处理
func handle() {
	divede(1, 0)
	//go divede(1, 0) // 跨协程
}

func divede(a int, b int) int {
	return a / b
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
