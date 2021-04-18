<?php
/**
 * 会字符长度溢出
 * @param $a
 * @param $b
 * @return string
 */
function addBinary($a, $b)
{
    $a = bindec($a);
    $b = bindec($b);
    $c = $a + $b;
    return decbin($c);
}

function addBinary2 ($a, $b)
{
    if ($a == '0') {
        return $b;
    } elseif ($b == '0') {
        return $a;
    }
    // 获取最后一个数的索引
    $lenA = strlen($a) - 1;
    $lenB = strlen($b) - 1;
    $str = '';
    // 进位标示
    $flag = 0;
    while ($lenA >= 0 || $lenB >= 0) {
        $valueA = $lenA < 0 ? 0 : (int)$a[$lenA];
        $valueB = $lenB < 0 ? 0 : (int)$b[$lenB];
        if (($value = $valueA + $valueB + $flag) == 2) {
            $flag = 1;
            $value = 0;
        } elseif ($value == 3) {
            // 进位为1，本身也为1了
            $flag = 1;
            $value = 1;
        } else {
            $flag = 0;
        }
        $str = ((string)$value) . $str;
        $lenA --;
        $lenB --;
    }
    if ($flag) {
        $str = '1' . $str;
    }
    return $str;
}

$a = "1010";
$b = "1011";
var_dump(addBinary($a, $b));