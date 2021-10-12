<?php
class Solution {

    /**
     * 59.螺旋矩阵II
     * 输入: 3
    输出:
     * n=3  -- 奇数 ，中间的特殊处理 res[1][1] = 8  ; floor(3/2)=1
    [
        [ 1, 2, 3 ],
        [ 8, 9, 4 ],
        [ 7, 6, 5 ]
    ]
     *
     *
     * n=2 -- 偶数
     * 【
     *      【1，2】
     *      【4，3】
     * 】
     *
     * n=4 -- 偶数
     * [
        [ 1, 2, 3, 4 ],
        [ 12, 13, 14, 5 ],
        [ 11, 16, 15, 6 ],
        [ 10, 9, 8, 7 ],
      ]
     */

    /**
     * @param Integer $n
     * @return Integer[][]
     */
    function generateMatrix($n)
    {
        if ($n == 0) return [];
        $res = [];
        // 先初始化数组，不然会有顺序问题
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $res[$i][$j] = 0;
            }
        }
        /**
         * 获得循环次数
         * 一次循环需要执行以下操作：
         *  填充上行从左到右
            填充右列从上到下
            填充下行从右到左
            填充左列从下到上
         */
        $num = 0;
        $loopNum = floor($n/2);
        for ($i = 0; $i < $loopNum; $i++) {
            // 每次循环减少两个单位
            // 从左到右,$a代表前进的单位数，单位数随着$i会变化减少
            for ($a = 0; $a < $n-1-$i*2; $a++) { // 注意 *2
                $res[$i][$i+$a] = ++$num;
            }
            // 填充右列从上到下
            for ($b = 0; $b < $n-1-$i*2; $b++) {
                $res[$i+$b][$n-1-$i] = ++$num;
            }
            // 填充下行从右到左
            for ($c = 0; $c < $n-1-$i*2; $c++) {
                $res[$n-1-$i][$n-1-$c-$i] = ++$num; // 注意关系式子$n-1-$c-$i
            }
            // 填充左列从下到上
            for ($d = 0; $d < $n-1-$i*2; $d++) {
                $res[$n-1-$d-$i][$i] = ++$num;
            }
        }

        if ( $n%2 == 1) {
            // 奇数，处理中间的数字；偶数不用处理
            $mid = floor($n/2);
            $res[$mid][$mid] = $n * $n;
        }
        return $res;
    }
}
$res = (new Solution())->generateMatrix(3);
print_r($res);
