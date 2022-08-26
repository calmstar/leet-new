package lodago

import (
	"bytes"
	"encoding/base64" //"encoding/json"
	"encoding/json"
	"fmt"
	"os"
	"reflect"
	"regexp"
	"sort"
	"strconv"
	"strings"
	"time"
	"unsafe"
	//"github.com/json-iterator/go"
	//json "github.com/pquerna/ffjson/ffjson"
)

//var jsonfast = jsoniter.ConfigFastest
var regexEnv *regexp.Regexp

func init() {
	regexEnv = regexp.MustCompile(`\$\{([^\}]*)\}`)

}
func StrSlice(s *string) (b []byte) {
	pbytes := (*reflect.SliceHeader)(unsafe.Pointer(&b))
	pstring := (*reflect.StringHeader)(unsafe.Pointer(s))
	pbytes.Data = pstring.Data
	pbytes.Len = pstring.Len
	pbytes.Cap = pstring.Len
	return
}
func RecursiveGet(src map[string]interface{}, keys []string) interface{} {
	cnt := len(keys)
	for idx := 0; idx < cnt-1; idx++ {
		src, _ = src[keys[idx]].(map[string]interface{})
		if src == nil {
			return nil
		}
	}
	return src[keys[cnt-1]]
}
func EnvString(o interface{}) string {
	str := ToString(o)
	if strings.HasPrefix(str, "~") {
		str = os.Getenv("HOME") + str[1:]
	}

	reginfos := regexEnv.FindAllStringSubmatch(str, -1)
	for _, items := range reginfos {
		str = strings.Replace(str, items[0], os.Getenv(items[1]), -1)
	}
	return str
}

func GetFilePath(str string, locale *time.Location) string {
	str = EnvString(str)
	timeFields := strings.Split(time.Now().Format("2006-01-02-15-04"), "-")
	if locale != nil {
		timeFields = strings.Split(time.Now().In(locale).Format("2006-01-02-15-04"), "-")
	}
	pathTimeFields := strings.Split("%Y-%m-%d-%H-%M", "-")
	for idx, timeField := range timeFields {
		str = strings.Replace(str, pathTimeFields[idx], timeField, -1)
	}
	return str
}

/*
func ToJsonFast(v interface{}) string {
	b, _ := jsonfast.Marshal(&v)
	if b == nil {
		return ""
	}

	return strings.TrimRight(ToString(b), "\n\r")
}
*/
func ToJson(v interface{}) string {
	buf := new(bytes.Buffer)
	enc := json.NewEncoder(buf)
	enc.SetEscapeHTML(false)
	enc.Encode(&v)
	return strings.TrimRight(buf.String(), "\n\r")
}

func ToJsonPlan(vstr map[string]string, vint64 map[string]int64, vfloat64 map[string]float64, extBytes []byte) []byte {
	buf := new(bytes.Buffer)
	buf.Grow(2048)
	buf.WriteByte('{')
	if vstr != nil {
		for k, v := range vstr {
			buf.WriteByte('"')
			buf.WriteString(k)
			buf.Write([]byte{'"', ':', '"'})
			buf.WriteString(v)
			buf.Write([]byte{'"', ','})
		}
	}
	if vint64 != nil {
		for k, v := range vint64 {
			buf.WriteByte('"')
			buf.WriteString(k)
			buf.Write([]byte{'"', ':'})
			buf.WriteString(strconv.FormatInt(v, 10))
			buf.WriteByte(',')
		}
	}
	if vfloat64 != nil {
		for k, v := range vfloat64 {
			buf.WriteByte('"')
			buf.WriteString(k)
			buf.Write([]byte{'"', ':'})
			buf.WriteString(strconv.FormatFloat(v, 'f', -1, 32))
			buf.WriteByte(',')
		}
	}
	cnt := buf.Len()
	if extBytes != nil {
		buf.Write(extBytes)
	}
	bb := buf.Bytes()
	bb[cnt-1] = '}'

	return bb
}

func Json2Array(b []byte) []map[string]interface{} {
	var array []map[string]interface{}
	if err := json.Unmarshal(b, &array); err != nil {
		return []map[string]interface{}{}
	}
	return array
}

func Json2Map(b []byte) map[string]interface{} {
	if b == nil || len(b) == 0 {
		return nil
	}
	var obj map[string]interface{}
	json.Unmarshal(b, &obj)

	return obj
}
func ToJsonBytes(v interface{}) []byte {
	buf := new(bytes.Buffer)
	enc := json.NewEncoder(buf)
	enc.SetEscapeHTML(false)
	enc.Encode(&v)
	return buf.Bytes()
}
func Map2Str(qs map[string]string, split, splitinner string) string {
	res := []string{}
	for k, v := range qs {
		res = append(res, k+splitinner+v)
	}
	return strings.Join(res, split)
}

func StrToMap(str, split, splitinner string) map[string]string {
	res := make(map[string]string)
	for _, strinner := range strings.Split(str, split) {
		fields := strings.SplitN(strinner, splitinner, 2)
		if len(fields) > 1 {
			res[fields[0]] = fields[1]
		}
	}

	return res
}

func BytesToMap(data []byte) (map[string]interface{}, error) {
	result := make(map[string]interface{})
	err := json.Unmarshal(data, &result)
	return result, err
}

func ToMap(structval interface{}) map[string]interface{} {
	m, _ := structval.(map[string]interface{})
	if m != nil {
		return m
	}
	refelem := reflect.ValueOf(structval).Elem()
	res := make(map[string]interface{})
	typeOfType := refelem.Type()
	for i := 0; i < refelem.NumField(); i++ {
		f := typeOfType.Field(i)
		res[f.Name] = refelem.Field(i).Interface()
	}
	return res
}

func ToInt64(v interface{}) int64 {
	if v == nil {
		return 0
	}
	switch x := v.(type) {
	case []byte:
		return ToInt64(string(x))
	case string:
		x = strings.TrimSpace(x)
		if x == "" {
			return 0
		}
		if strings.Contains(x, ".") {
			f, _ := strconv.ParseFloat(x, 64)
			return int64(f)
		}
		res, _ := strconv.ParseInt(x, 10, 64)
		return res
	case int:
		return int64(x)
	case int8:
		return int64(x)
	case int16:
		return int64(x)
	case int32:
		return int64(x)
	case int64:
		return int64(x)
	case uint:
		return int64(x)
	case uint8:
		return int64(x)
	case uint16:
		return int64(x)
	case uint32:
		return int64(x)
	case uint64:
		return int64(x)
	case float32:
		return int64(x)
	case float64:
		return int64(x)
	case bool:
		if x {
			return 1
		}
		return 0
	default:
		return 0
	}
}

func ToBase64Str(v interface{}) string {
	if v == nil {
		return ""
	}
	if bytes, ok := v.([]byte); ok {
		return base64.StdEncoding.EncodeToString(bytes)
	}

	rt := reflect.TypeOf(v)
	switch rt.Kind() {
	case reflect.String:
		return base64.StdEncoding.EncodeToString([]byte(v.(string)))
	}
	buf := new(bytes.Buffer)
	enc := json.NewEncoder(buf)
	enc.SetEscapeHTML(false)
	enc.Encode(&v)
	return base64.StdEncoding.EncodeToString(buf.Bytes())
}

func ToFloat64(v interface{}) float64 {
	if v == nil {
		return 0
	}
	var res float64
	if str, ok := v.([]byte); ok {
		res, _ = strconv.ParseFloat(strings.TrimSpace(string(str)), 64)
		return res
	}
	if str, ok := v.(string); ok && str != "" {
		res, _ = strconv.ParseFloat(strings.TrimSpace(str), 64)
		return res
	}
	if f64, ok := v.(float64); ok {
		return f64
	}
	if f32, ok := v.(float32); ok {
		return float64(f32)
	}
	if i64, ok := v.(int64); ok {
		return float64(i64)
	}
	if i32, ok := v.(int32); ok {
		return float64(i32)
	}
	if i16, ok := v.(int16); ok {
		return float64(i16)
	}
	if i, ok := v.(int); ok {
		return float64(i)
	}
	switch t := v.(type) {
	case int8:
		return float64(t)
	case uint8:
		return float64(t)
	case uint16:
		return float64(t)
	case uint32:
		return float64(t)
	case uint64:
		return float64(t)
	}
	return res
}

/*
直接用string
*/
// deprecated
func StrBytesString(b []byte) *string {
	return (*string)(unsafe.Pointer(&b))
}

func ToBytes(v interface{}) []byte {

	if bytes, ok := v.([]byte); ok {
		return bytes
	}
	var b []byte
	if s, ok := v.(string); ok && s != "" {
		pbytes := (*reflect.SliceHeader)(unsafe.Pointer(&b))
		pstring := (*reflect.StringHeader)(unsafe.Pointer(&s))
		pbytes.Data = pstring.Data
		pbytes.Len = pstring.Len
		pbytes.Cap = pstring.Len
	}
	return b
}
func ToStringWrap(v interface{}) string {
	vStr := ToString(v)
	buf := new(bytes.Buffer)
	buf.WriteByte('"')
	for _, c := range vStr {
		if c == '\\' || c == '"' {
			buf.WriteByte('\\')
		}
		buf.WriteRune(c)
	}
	buf.WriteByte('"')
	return buf.String()
}

func MapToLine(mstr map[string]string) string {
	keys := []string{}
	for k := range mstr {
		keys = append(keys, k)
	}
	sort.Strings(keys)
	vals := []string{}
	for _, k := range keys {
		vals = append(vals, k+"="+mstr[k])
	}
	return strings.Join(vals, "`")
}
func ToStringAndTrim(v interface{}) string {
	return strings.TrimSpace(ToString(v))
}

/*
 */
func ToString(v interface{}) string {
	if v == nil {
		return ""
	}
	if bytes, ok := v.([]byte); ok {
		return string(bytes)
	}

	rt := reflect.TypeOf(v)
	switch rt.Kind() {
	case reflect.String:
		return v.(string)
		//case reflect.Int, reflect.Float32, reflect.Float64, reflect.Int16, reflect.Int32, reflect.Int64, reflect.Int8, reflect.Uint, reflect.Uint32, reflect.Uint64, reflect.Uint8:
		//	bytes, _ := json.Marshal(v)
		//	return string(bytes)

	case reflect.Int, reflect.Int16, reflect.Int32, reflect.Int64, reflect.Int8, reflect.Uint, reflect.Uint32, reflect.Uint64, reflect.Uint8:
		//i, _ := v.(int)
		//return strconv.Itoa(i)
		return fmt.Sprintf("%d", v)
	case reflect.Float32, reflect.Float64:
		bytes, _ := json.Marshal(v)
		return string(bytes)
		//return str

	case reflect.Struct:
		return ToJson(v)
	default:
		return ToJson(v)
	}
}

/*
 */
func ToInt(v interface{}) int {
	if v == nil {
		return 0
	}
	res := 0
	if str, ok := v.([]byte); ok {
		f, _ := strconv.ParseFloat(strings.TrimSpace(string(str)), 64)
		return int(f)
	}
	if str, ok := v.(string); ok && str != "" {
		f, _ := strconv.ParseFloat(strings.TrimSpace(str), 64)
		return int(f)
	}
	if f64, ok := v.(float64); ok {
		return int(f64)
	}
	if i64, ok := v.(int64); ok {
		return int(i64)
	}
	if i32, ok := v.(int32); ok {
		return int(i32)
	}
	if i16, ok := v.(int16); ok {
		return int(i16)
	}

	if i, ok := v.(int); ok {
		return i
	}

	return res
}

/*
 */
func ToInt32(v interface{}) int32 {
	if v == nil {
		return 0
	}
	res := 0
	if str, ok := v.([]byte); ok {
		res, _ = strconv.Atoi(strings.TrimSpace(string(str)))
		return int32(res)
	}
	if str, ok := v.(string); ok && str != "" {
		res, _ = strconv.Atoi(strings.TrimSpace(str))
		return int32(res)
	}
	if f64, ok := v.(float64); ok {
		return int32(f64)
	}
	if i64, ok := v.(int64); ok {
		return int32(i64)
	}
	if i32, ok := v.(int32); ok {
		return int32(i32)
	}
	if i16, ok := v.(int16); ok {
		return int32(i16)
	}

	if i, ok := v.(int); ok {
		return int32(i)
	}

	return int32(res)
}

//更加json tag转Map ，传入类型必须是struct 指针
func ToMapReferJsonTag(structval interface{}) map[string]interface{} {
	m, _ := structval.(map[string]interface{})
	if m != nil {
		return m
	}
	refelem := reflect.ValueOf(structval).Elem()
	res := make(map[string]interface{})
	typeOfType := refelem.Type()
	for i := 0; i < refelem.NumField(); i++ {
		f := typeOfType.Field(i)
		tag := f.Tag.Get("json")
		if tag == "" {
			tag = f.Name
		}
		res[tag] = refelem.Field(i).Interface()
	}
	return res
}

func ToBool(v interface{}) bool {
	switch n := v.(type) {
	case bool:
		return n
	case string:
		n = strings.ToLower(n)
		return n == "true" || n == "ok"
	case []byte:
		s := ToString(v)
		s = strings.ToLower(s)
		return s == "true" || s == "ok"
	default:
		i := ToInt(v)
		return i != 0
	}
}

// 有 _b64则转移回来，没有则取原字段的值
func FromB64(key string, qs map[string]string) string {
	//传参时:  &test_b64=6IKl6a2U  或者 &test=肥魔 经过本方法处理之后，qs["test"]中的值是一样的， 是一样的
	// 用法： go: FromB64("test_b64", qs)

	if key == "" && !strings.HasSuffix(key, "_b64") {
		return ""
	}

	originKey := regexp.MustCompile("_b64$").ReplaceAllString(key, "")
	if b64, hit := qs[key]; hit && b64 != "" {
		if originKey == "" {
			return ""
		}

		var b []byte
		b, err := base64.StdEncoding.DecodeString(b64)
		if err != nil {
			return ""
		}
		qs[originKey] = string(b)
	}

	return qs[originKey]

}
