<?php
class Solution {

    /**
     * 迭代
     * @param Integer $n
     * @return Integer
     */
    function fibV2($n) {
        if ($n < 2) return $n;
        $curr = 0;
        $next = 1;
        $all = 0;
        for ($i = 2; $i <= $n; $i++) {
            $all = ($curr + $next) % (pow(10, 9)+7);
            $curr = $next;
            $next = $all;
        }
        return $all;
    }

    private $memo = [];
    function fib ($n)
    {
        if ($n < 2) return $n;
        if ($n == 2) return 1;
        if (isset($this->memo[$n])) {
            return $this->memo[$n];
        }

        $this->memo[$n] = ($this->fib($n-1) + $this->fib($n-2)) % (pow(10, 9)+7);
        return $this->memo[$n];
    }

}
$res = (new Solution())->fib(95);
var_dump($res);
/**
 *
 * 答案需要取模 1e9+7（1000000007），如计算初始结果为：1000000008，请返回 1。


 * 45
输出：
1134903170   1134903170
预期结果：
134903163
 */