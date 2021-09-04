<?php

/**
 * https://mp.weixin.qq.com/s/EVhp3D_hwI8RFZlu5sQaIA
 * 高效寻找素数
 *
 * // 返回区间 [2, n) 中有几个素数
int countPrimes(int n)

// 比如 countPrimes(10) 返回 4
// 因为 2,3,5,7 是素数
 *
 * 如果一个数如果只能被 1 和它本身整除，那么这个数就是素数。
 */

// 时间复杂度：O(n2)
function countPrimesV1 ($n)
{
    $count = 0;
    for ($i = 2; $i < $n; $i++) {
        $res = isPrime($i);
        if ($res) {
            $count++;
        } else {
            continue;
        }
    }
    return $count;
}
function isPrime ($n)
{
    for ($i = 2; $i < $n; $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// ----------- v2 -------------

/**
 * i不需要遍历到n，而只需要到sqrt(n)即可。为什么呢，我们举个例子，假设n = 12。

12 = 2 × 6
12 = 3 × 4
12 = sqrt(12) × sqrt(12)
12 = 4 × 3
12 = 6 × 2
 *
 * 可以看到，后两个乘积就是前面两个反过来，反转的分界点就在sqrt(n)。
 *
 * 时间复杂度降为了 O(sqrt(N))
 */
function countPrimesV2 ($n)
{
    $count = 0;
    for ($i = 2; $i * $i < $n; $i++) {
        $res = isPrime($i);
        if ($res) {
            $count++;
        } else {
            continue;
        }
    }
    return $count;
}

// ------------------ v3 ----------------

/**
 * 通过哈希布尔数组来判断某个数是否是素数
 * 3 也是素数，那么 3 × 2 = 6, 3 × 3 = 9, 3 × 4 = 12… 也都不可能是素数了。
 *
 *  O(N * loglogN)，
 * @param $n
 */
function countPrimesV3 ($n)
{
    // 初始化
    $isPrimeArr = [];
    for ($i = 1; $i < $n; $i++) {
        $isPrimeArr[$i] = true;
    }
    // $i * $i 素数只在[2, sqrt(n)]范围内
    for ($i = 2; $i * $i < $n; $i++) {
        if ($isPrimeArr[$i]) {
            // 素数的倍数都不可能是素数; 优化点 $i * $i，去除冗余计算
            for ($j = $i * $i; $j < $n; $j += $i) {
                $isPrimeArr[$j] = false;
            }
        }
    }
    // 计算为true的数量
    $count = 0;
    for ($i = 1; $i < $n; $i++) {
        if ($isPrimeArr[$i]) $count++;
    }
    return $count;
}