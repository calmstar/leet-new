<?php

/**
 *  https://mp.weixin.qq.com/s/8lJNdnJ0tWm2CapiW_u7XA
 * https://mp.weixin.qq.com/s/YFpR9JMhwQ4bGYJ9KPe5Yg
 *  以下都是对二进制位的操作：
 *  & 与
 *  | 或
 *  ~ 非
 *  ^ 异或    同为假，异为真
 *  >> 右移   8 >> 1 = 4  相当于 8/2=4
 *  << 左移   8 << 1 = 16  相当于 8*2=4
 *
 * 逻辑运算符 -- 返回true false
 *  &&
 *  ||
 *  !
 */

function judgeNum ($number)
{
    if ($number % 2 == 1 ) echo '是个奇数' . PHP_EOL;

    // 二进制运算: 主要是判断 $number 二进制位的最后一位是否为1，如果是则说明是奇数
    if (($number & 1) == 1) echo '是个奇数' . PHP_EOL;
}
judgeNum(3);


/**
 * 交换数字，无$tmp变量
 * 异或，相同为0，不同为1
 * @param $a
 * @param $b
 */
function exchange ($a, $b)
{
    echo "a:{$a}, b:{$b}" . PHP_EOL;
    $a = $a ^ $b; // a=a^b
    $b = $a ^ $b; // b=(a^b)^b=a^0=a
    $a = $a ^ $b; // a=(a^b)^(a^b^b)=0^b=0
    echo "convert: a:{$a}, b:{$b}" . PHP_EOL;
}
exchange(1, 2);


/**
 *  二进制中1的个数
 * 要求输入一个整数，输出该数二进制表示中1的个数(其中负数用补码表示)。
 * 输入 3 = 011
 * 结果为 2
 *
 * 原理：
 *      n - 1 一定可以消除最后一个 1，同时把其后的 0 都变成 1，这样再和 n 做一次 & 运算，就可以仅仅把最后一个 1 变成 0 了。
 */
function count1 ($number)
{
    if (empty($number)) return 0;
    $res = 0;
    while ($number != 0 ) {
        $res++;
        $number = ($number & ($number-1)); // 每次消除最右边的一个1
    }
    echo "{$number} 的二进制位中 1 的个数有 {$res} 个" . PHP_EOL;
}
count1(4);

/**
 * 判断一个数是不是 2 的指数
 * 解析：2的指数，二进制位中只有一个1
 */
function isPowerOfTwo ($n)
{
    if ($n <= 0) return false;
    return ($n & ($n-1)) == 0;
}

/**
 * 查找只出现一次的元素
 * 如：[2, 2, 1] 1只出现了1次，返回1
 *
 * 原理：
 *      运用异或运算的性质：
        一个数和它本身做异或运算结果为 0，即 a ^ a = 0；
 *      一个数和 0 做异或运算的结果为它本身，即 a ^ 0 = a。
 */
function findSingleNumber ($arr)
{
    $res = 0;
    foreach ($arr as $v) {
        $res ^= $v;
    }
    return $res;
}

