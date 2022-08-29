package main

import (
	"bufio"
	"fmt"
	"io"
	"os"
	"regexp"
	"strings"
)

func GetFileData() {
	line := `2022/08/25 16:27:11 /Users/chenwenxing/go/src/tpcheer/login/internal/handler.go:332: [debug] start_user_login: uid: 30983882, country: HK, ip: 137.59.103.202:55753, IdentityType: device`
	formatAndOutput(line)

	//filepath := "/Users/chenwenxing/Desktop/data.csv"
	filepath := "/Users/chenwenxing/Desktop/test333.txt"
	file, err := os.OpenFile(filepath, os.O_RDWR, 0666)
	if err != nil {
		fmt.Println("Open file error!", err)
		return
	}
	defer file.Close()
	stat, err := file.Stat()
	if err != nil {
		panic(err)
	}
	var size = stat.Size()
	fmt.Println("file size=", size)

	buf := bufio.NewReader(file)
	for {
		line, err := buf.ReadString('\n')
		line = strings.TrimSpace(line)

		formatAndOutput(line)
		//fmt.Println(line)

		if err != nil {
			if err == io.EOF {
				fmt.Println("File read ok!")
				break
			} else {
				fmt.Println("Read file error!", err)
				return
			}
		}
	}

}

func formatAndOutput(line string) {
	if line == "" {
		return
	}
	// 正则匹配
	buf := line
	//解析正则表达式，如果成功返回解释器
	reg1 := regexp.MustCompile(`country: (.*), ip: `)
	if reg1 == nil {
		fmt.Println("regexp err")
		return
	}
	//根据规则提取关键信息
	result1 := reg1.FindAllStringSubmatch(buf, -1) //查找全部，二维
	fmt.Println(result1, len(result1[0]), result1[0][1])
	fmt.Println([]int{1, 2, 3, 4})
	os.Exit(0)

}

func IsContain(items []string, item string) bool {
	for _, eachItem := range items {
		if eachItem == item {
			return true
		}
	}
	return false
}
