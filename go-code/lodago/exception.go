package lodago

import (
	"fmt"
	"runtime"
)

func TryCatch(fun func(), handler func(interface{})) {
	defer func() {
		if err := recover(); err != nil {
			buf := make([]byte, 4096)
			n := runtime.Stack(buf, false)
			stackInfo := fmt.Sprintf("%v %s", err, buf[:n])
			handler(stackInfo)
		}
	}()
	fun()
}
