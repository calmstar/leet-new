package lodago

import (
	"math/rand"
	"sync"
	"time"

	uuid "github.com/satori/go.uuid"
)

var lockRand *sync.Mutex
var lockRandInst *sync.Mutex
var randInst *rand.Rand

// UUID 生成唯一的uuid
func UUID() string {
	uuid, _ := uuid.NewV4()
	return uuid.String()
}

// 数字 + 大小写字母
const alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
const numBytes = "0123456789"
const lowerBytes = "abcdefghijklmnopqrstuvwxyz"
const upperBytes = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
const (
	alphabetIdxBits = 6
	alphabetIdxMask = 1<<alphabetIdxBits - 1
	alphabetIdxMax  = 63 / alphabetIdxBits
	numIdxBits      = 4
	numIdxMask      = 1<<numIdxBits - 1
	numIdxMax       = 63 / numIdxBits
	lowerIdxBits    = 5
	lowerIdxMask    = 1<<lowerIdxBits - 1
	lowerIdxMax     = 63 / lowerIdxBits
	upperIdxBits    = 5
	upperIdxMask    = 1<<upperIdxBits - 1
	upperIdxMax     = 63 / upperIdxBits
)

var preRandomSeed = []int{73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997, 1009, 1013, 1019, 1021, 1031, 1033, 1039, 1049, 1051, 1061, 1063, 1069}
var preRandomIdx int = 100086
var preRandomVal int = 0

var src = rand.NewSource(time.Now().UnixNano())

// RandString 随机字符串（数字 + 大小写字母）
func RandString(n ...int) string {
	num := 64
	if len(n) > 0 {
		num = n[0]
	}
	b := make([]byte, num)
	for i, cache, remain := num-1, src.Int63(), alphabetIdxMax; i >= 0; {
		if remain == 0 {
			cache, remain = src.Int63(), alphabetIdxMax
		}
		if idx := int(cache & alphabetIdxMask); idx < len(alphabet) {
			b[i] = alphabet[idx]
			i--
		}
		cache >>= alphabetIdxBits
		remain--
	}
	return Bytes2String(b)
}

// RandStrWithNum 随机生成数字字符串
func RandStrWithNum(n ...int) string {
	num := 64
	if len(n) > 0 {
		num = n[0]
	}
	b := make([]byte, num)
	for i, cache, remain := num-1, src.Int63(), numIdxMax; i >= 0; {
		if remain == 0 {
			cache, remain = src.Int63(), numIdxMax
		}
		if idx := int(cache & numIdxMask); idx < len(numBytes) {
			b[i] = numBytes[idx]
			i--
		}
		cache >>= numIdxBits
		remain--
	}
	return Bytes2String(b)
}

// RandStrWithLower 随机生成小写字母字符串
func RandStrWithLower(n ...int) string {
	num := 64
	if len(n) > 0 {
		num = n[0]
	}
	b := make([]byte, num)
	for i, cache, remain := num-1, src.Int63(), lowerIdxMax; i >= 0; {
		if remain == 0 {
			cache, remain = src.Int63(), lowerIdxMax
		}
		if idx := int(cache & lowerIdxMask); idx < len(lowerBytes) {
			b[i] = lowerBytes[idx]
			i--
		}
		cache >>= lowerIdxBits
		remain--
	}
	return Bytes2String(b)
}

// RandStrWithUpper 随机生成大写字母字符串
func RandStrWithUpper(n ...int) string {
	num := 64
	if len(n) > 0 {
		num = n[0]
	}
	b := make([]byte, num)
	for i, cache, remain := num-1, src.Int63(), upperIdxMax; i >= 0; {
		if remain == 0 {
			cache, remain = src.Int63(), upperIdxMax
		}
		if idx := int(cache & upperIdxMask); idx < len(upperBytes) {
			b[i] = upperBytes[idx]
			i--
		}
		cache >>= upperIdxBits
		remain--
	}
	return Bytes2String(b)
}

func GetRandom64() int64 {
	lockRandInst.Lock()
	defer lockRandInst.Unlock()
	return randInst.Int63()
}

func GetRandom(rmax int) int {
	max := 0xFFFFFFFF
	if rmax > max {
		max = rmax
	}
	lockRand.Lock()
	if preRandomIdx >= len(preRandomSeed) {
		go func() {
			preRandomVal = int(GetRandom64()) % max
		}()
		preRandomIdx = 0
	}
	preRandomVal = preRandomVal + preRandomSeed[preRandomIdx]
	preRandomIdx++
	lockRand.Unlock()
	return preRandomVal % rmax
}
