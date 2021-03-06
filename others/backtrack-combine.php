<?php
// 关于排列组合

/**
 * https://mp.weixin.qq.com/s/qT6WgR6Qwn7ayZkI3AineA
 * 回溯算法 --- 穷举
 * 组合问题
 * 输入两个数字 n, k，算法输出 [1..n] 中 k 个数字的所有组合
 *
 * 比如输入 n = 4, k = 2，输出如下结果，顺序无所谓，但是不能包含重复（按照组合的定义，[1,2] 和 [2,1] 也算重复）：
[
[1,2],
[1,3],
[1,4],
[2,3],
[2,4],
[3,4]
]
 */

class Solution {

    private $res = [];
    /**
     * @param $n integer 决定宽度
     * @param $k integer 决定高度
     */
    function combine ($n, $k)
    {
        $start = 1;
        $tracking = [];
        $this->backtracking($n, $k, $start, $tracking);
        return $this->res;
    }

    function backtracking ($n, $k, $start, $tracking)
    {
        if (count($tracking) == $k) {
            $this->res[] = $tracking;
            return;
        }

        for ($i = $start; $i <= $n; $i++) {
            array_push($tracking, $i);
            // 注意这里start的值是在i+1；也可以让其从0开始，但是就需要判断是否存在in_array(xx, $track)
            $this->backtracking($n, $k, $i+1, $tracking);
            array_pop($tracking);
        }
    }
}
$n = 4;
$k = 2;
$res = (new Solution())->combine($n, $k);
print_r($res);


/**
 *  相关知识：
 *
 * 组合：顺序无关  数学符号 C
 * 排列：顺序有关  数学符号 A
 *
 * 举例：
 * 1 全排列：
 *      [1,2,3] 的所有全排列：6（数学中的排列，顺序有关区分：A3-3 = 3*2*1 = 6 ）
 *          [1,2,3] [1,3,2]
 *          [2,3,1] [2,1,3]
 *          [3,1,2] [3,2,1]
 *
 * 2 全组合：
 *      [1,2,3] 的所有全组合：1（数学中的组合，顺序没关区分：C3-3 = 3*2*1/3*2*1 = 1 ）
 *          [1,2,3]
 *
 * 3 子集/子组合：
 *      [1,2,3]的所有子集(子组合)：8
 *      （ 顺序无关-组合问题：C3-1 + C3-2 + C3-3 = (3) + (3*2/2*1) + (3*2*1/3*2*1) ） = 3+3+1 = 7 + 1(空子集) = 8
 *          [
 *              [],
 *              [1],[2],[3], --3
 *              [1,3],[2,3],[1,2], --3
 *              [1,2,3]  --1
 *          ]
 *
 * 4 子排列：
 *      [1,2,3]的所有子排列：
 *      顺序有关-排列问题：A3-1 + A3-2 + A3-3 = (3 + 3*2 + 3*2*1) = 3+6+6 = 15+1(空子集) = 16
 *        [
*              [],
*              [1],[2],[3], --3
*              [1,3],[2,3],[1,2], --3
*              [1,2,3]  --1
 *              // --- 基础上增加多顺序相关的，变成'排列'，顺序相关
 *             [3,1],[3,2],[2,1] --3 注：加上上面3个，正好 3+3 = 6 = A3-2
 *             [1,3,2] [2,3,1] [2,1,3] [3,1,2] [3,2,1] --5 注：加上上面1个，正好 5+1 = 6 = A3-3
*          ]
 *
 *      这里的16个，其实就是全排列树的所有元素：https://mp.weixin.qq.com/s/qT6WgR6Qwn7ayZkI3AineA
 *      16个里面根据不同的题意，筛选得出不同的结果（如组合，子集问题等）
 *
 */

/**
 *  问题：求 123 的子序列，子串
 *
 * 1 子序列（数组的子集 子组合问题，组合-C计算方式（跟上面算法一样））：
 *      '' (空字符)
 *      1 2 3
 *      12 23 13
 *      123
 *  共 8 个子序列。 8 = 2的3次方 = 8
 * 子序列个数计算公式：2的n次方
 * 或
 * C3-1 + C3-2 + C3-3 = (3) + (3*2/2*1) + (3*2*1/3*2*1) ） = 3+3+1 = 7 + 1(空子集) = 8
 *
 * 2 子串（连续子数组）（特殊：计算公式方法不一样）（要相邻）：
 *      '' (空字符)
 *      1 2 3
 *      12  23
 *      123
 *      共 7 个子串。7 = 3(3+1)/2+1 = 7
 * 子串个数计算公式：n(n+1)/2 + 1
 * 推导思路-切割法：https://blog.csdn.net/dpj514/article/details/79048526
 *
 */

/**
 * 穷举 全排列，全组合，子组合（子集subset 子序列），子排列 都可以用回溯法，并且都有代码讲解了：参考上下文件
 *
 * 穷举 子串（substr）（或连续子数组问题）：使用双重for循环进行遍历，然后substr进行获得：参考/Users/starc/code/leet-new/others/interation-substr.php
 *
 */

