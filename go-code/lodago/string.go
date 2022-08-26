package lodago

import (
	"encoding/json"
	"log"
	"reflect"
	"regexp"
	"strconv"
	"strings"
	"unsafe"
)

// 这里是github.com/gookit/goutil/arrutil库内的实现，感谢作者。

var (
	toSnakeReg  = regexp.MustCompile("[A-Z][a-z]")
	toCamelRegs = map[string]*regexp.Regexp{
		" ": regexp.MustCompile(" +[a-zA-Z]"),
		"-": regexp.MustCompile("-+[a-zA-Z]"),
		"_": regexp.MustCompile("_+[a-zA-Z]"),
	}
)

// LowerFirst ABC -> aBC
func LowerFirst(s string) string {
	if len(s) == 0 {
		return s
	}
	f := s[0]
	if f >= 'A' && f <= 'Z' {
		return strings.ToLower(string(f)) + s[1:]
	}
	return s
}

// UpperFirst abc -> Abc
func UpperFirst(s string) string {
	if len(s) == 0 {
		return s
	}
	f := s[0]
	if f >= 'a' && f <= 'z' {
		return strings.ToUpper(string(f)) + s[1:]
	}
	return s
}

// CamelCase "group_id" -> "groupId"
func CamelCase(s string, sep ...string) string {
	sepChar := "_"
	if len(sep) > 0 {
		sepChar = sep[0]
	}
	if !strings.Contains(s, sepChar) {
		return s
	}
	rgx, ok := toCamelRegs[sepChar]
	if !ok {
		rgx = regexp.MustCompile(regexp.QuoteMeta(sepChar) + "+[a-zA-Z]")
	}
	return rgx.ReplaceAllStringFunc(s, func(s string) string {
		s = strings.TrimLeft(s, sepChar)
		return UpperFirst(s)
	})
}

// SnakeCase "GroupId" -> "group_id"
func SnakeCase(s string, sep ...string) string {
	sepChar := "_"
	if len(sep) > 0 {
		sepChar = sep[0]
	}
	newStr := toSnakeReg.ReplaceAllStringFunc(s, func(s string) string {
		return sepChar + LowerFirst(s)
	})
	return strings.TrimLeft(newStr, sepChar)
}

// String2Bytes 字符串转换byte切片 零拷贝
func String2Bytes(s string) []byte {
	stringHeader := (*reflect.StringHeader)(unsafe.Pointer(&s))

	bh := reflect.SliceHeader{
		Data: stringHeader.Data,
		Len:  stringHeader.Len,
		Cap:  stringHeader.Len,
	}

	return *(*[]byte)(unsafe.Pointer(&bh))
}

// Bytes2String byte切片转换字符串 零拷贝
func Bytes2String(b []byte) string {
	sliceHeader := (*reflect.SliceHeader)(unsafe.Pointer(&b))

	sh := reflect.StringHeader{
		Data: sliceHeader.Data,
		Len:  sliceHeader.Len,
	}

	return *(*string)(unsafe.Pointer(&sh))
}

// IsNum 判断字符串是不是整数
func IsNum(s string) bool {
	_, err := strconv.Atoi(s)
	return err == nil
}

func String2slice(s string) []int {
	if s == "" {
		return []int{}
	}

	var slice []int
	err := json.Unmarshal([]byte(s), &slice)
	if err != nil {
		log.Printf("string2slice error %v", err.Error())
		return nil
	}
	//fmt.Println(slice)
	return slice
}

func Slice2string(slice []int) string {
	data, err := json.Marshal(slice)
	if err != nil {
		log.Printf("slice2string error %v", err.Error())
		return ""
	}
	//fmt.Println(string(data))
	return string(data)
}

func String2Struct(s string, v interface{}) interface{} {
	if s == "" {
		log.Printf("String2Struct Unmarshal error: s == ''")
		return v
	}

	err := json.Unmarshal([]byte(s), v)
	if err != nil {
		log.Printf("String2Struct Unmarshal error: %v", err)
	}

	return v
}

func Struct2String(v interface{}) string {
	if v == nil {
		log.Printf("String2Struct Unmarshal error: v == nil")
		return ""
	}

	data, err := json.Marshal(v)
	if err != nil {
		log.Printf("Struct2String error: %v", err)
		return ""
	}

	return string(data)
}
