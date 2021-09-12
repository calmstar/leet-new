<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/26
 * Time: 15:45
 */

/**
 * [1, 2, 4, 1, 7, 8, 3] 求出该数组非邻近的n个数最大之和。
 * 比如可以 1+4 1+7 而不能 1+2
 *  资料：https://www.bilibili.com/video/av18512769
 *
 * 分析：
 *      适用动态规划思想，求出最优解。
 *      将数组从后往前推断，假设：
 *                  选了3，就不能选8，但可以选7及其后面的数字；
 *                          选了7，就不能选1，但可以选4及其后面的数字
 *                          不选7，可以选1及其后面的数字
 *                          ...
 *                  不选3，可以选8及其后面的数字
 *                          选了8，就不能选7，但可以选1及其后面的数字
 *                          不选8，可以选7及其后面的数字
 *                          ...
 *                  ...
 *      类似递归模式，通项公式(opt == optimistic 为最优解的意思)：
 *                      opt(i) = max( opt(i-1), ( opt(i-2) + $arr[i] ) )
 *                      注：i为当前数组的索引位置
 *              递归出口：
 *                  i = 0时，opt(0) = $arr[0] (当数组只有一个数时，则最大和就是该数)
 *                  i = 1时，opt(1) = max($arr[0], $arr[1])  （当数组有两个数时，则最大和就是两者的最大值（因为互为相邻，所以不能相加））
 *
 *
 * @param $arr
 * @return mixed
 */
function dynamicProgramMaxSum ($arr)
{
    $cou = count($arr);
    if ($cou == 1) return $arr[0];
    if ($cou == 2) return $arr[0] > $arr[1] ? $arr[0] : $arr[1];
    $optArr1 = array_slice($arr,0,$cou-1);
    $optArr2 = array_slice($arr,0,$cou-2);
    $a = dynamicProgramMaxSum($optArr1); // 优化：备忘录算法，将json_encode($optArr1)作为key存起对应的value。防止重叠子问题，造成的计算浪费
    $b = dynamicProgramMaxSum($optArr2) + $arr[$cou-1];
    return $a > $b ? $a : $b;
}

function dynamicProgramMaxSumV2 ($arr)
{
    $cou = count($arr);
    $opt = [];
    $opt[0] = $arr[0];
    $opt[1] = $arr[0] > $arr[1] ? $arr[0] : $arr[1];

    for ($i = 2; $i < $cou; $i++) {
        // 将递归公式写在此处. $opt的索引$i,代表数组中前$i个元素的最大和
        $a = $opt[$i-1];
        $b = $opt[$i-2] + $arr[$i];
        $opt[$i] = $a > $b ? $a : $b;
    }
    $index = count($arr) - 1;
    return $opt[$index];
}

$arr = [1, 2, 4, 1, 7, 8, 3];
var_dump(dynamicProgramMaxSum($arr));
var_dump(dynamicProgramMaxSumV2($arr));
