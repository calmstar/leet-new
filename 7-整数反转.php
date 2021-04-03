<?php

/**
 * @param Integer $x
 * @return Integer
 */
function reverse($x) {
    $fh = $x < 0 ? '-' : '';
    $info = $fh.abs(strrev($x)); //反转字符串并取绝对值 然后加上正负符号
    $min = pow(-2,31);  //返回数值最大最小区间
    $max = pow(2,31)-1;
    if($info >= $min && $info <= $max){ //如果在区间内输出原值否则返回0
        return $info;
    }else{
        return 0;
    }
}

