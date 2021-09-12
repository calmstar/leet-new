<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/7/29
 * Time: 1:00
 */

/**
 * 梯度计算手续费
 *
 *      1-5     30/笔
 *      6-20    15/笔
 *      21-50   10/笔
 *      50-~~   1/笔
 *
 * 现在给出一个笔数 $n, 求出手续费是多少。尽量简洁，配置化
 */

function getAccount ($n)
{
    if ($n <= 0) return 0;
    $cash = 0;
    $accountConfigArr = getAccountConfig();
    foreach ($accountConfigArr as $v) {
        if ($v['left'] <= $n && ($v['right'] >= $n || $v['right'] == 0)) {
            $cash = ($n - $v['left'] - 1) * $v['perCash'] + getAccount($n - $v['left'] - 1);
            break;
        }
    }
    return $cash;

}

function getAccountConfig ()
{
    // 0代表无穷大
    return [
        ['left' => 1, 'right' => 5, 'perCash' => 30],
        ['left' => 6, 'right' => 20, 'perCash' => 15],
        ['left' => 21, 'right' => 50, 'perCash' => 10],
        ['left' => 50, 'right' => 0, 'perCash' => 1],
    ];
}