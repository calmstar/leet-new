<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/23
 * Time: 11:21
 */

/**
 * 与 leetcode 70-climbstairs 类似
 *
 *
 * 斐波那契数列
 * 斐波那契数列指的是这样一个数列 1, 1, 2, 3, 5, 8, 13, 21, 34......
从上面数列中可以看到，从第3项开始，每一项都等于前两项之和。
 *
 * 求第 n 个数的值
 */

/**
 * @param $n 规定只为正整数
 * @return int
 */
function fibonacci ($n)
{
    if ($n == 1 || $n == 2) return 1;
    return fibonacci($n-1) + fibonacci($n-2);
    // 使用递归会出现很多重叠子问题（O(2的n次方)），可用备忘录算法（O(n),leetcode-70）
}

/**
 * 将递归改成for循环
 * @param $n
 * @return int
 */
function fibonacciOfFor ($n)
{
    if ($n == 1 || $n == 2) return 1;
    // 得到起始值，然后从3开始计算到n。
    // for循环为顺序执行，由开始值推导到结果值
    // 递归为从结果值，反向递推到初始值，然后计算归纳得出结果
    $f1 = 1;
    $f2 = 1;
    $current = 0;
    for ($i = 3; $i <= $n; $i++) {
        $current = $f1 + $f2;
        $f1 = $f2;  // 针对下一个数值，更新其前面的两个数值
        $f2 = $current;
    }
    return $current;
}

echo "递归值：" . fibonacci(6) . "\n";
echo "循环值：" . fibonacciOfFor(6) . "\n";

/**
 * 递归虽然有简洁的优点，但它同时也有显著地缺点。递归由于是函数调用自身，
 * 而函数调用是有空间和时间的消耗的：每一次函数调用，都需要在内存栈中分配空间以保存参数、返回地址及临时变量，
 * 而且往栈里压入数据和弹出数据都需要时间。

    而且除了效率问题之外，递归可能引起 调用栈溢出，因为需要为每一次函数调用在内存栈中分配空间，
 * 而每个进程的栈的容量是有限的。当蒂固的层级太多，就会超出栈的容量，导致栈溢出

 */