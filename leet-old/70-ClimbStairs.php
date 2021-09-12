<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/23
 * Time: 10:46
 */

/**
 * 假设你正在爬楼梯。需要 n 阶你才能到达楼顶。

每次你可以爬 1 或 2 个台阶。你有多少种不同的方法可以爬到楼顶呢？

注意：给定 n 是一个正整数。

示例 1：

输入： 2
输出： 2
解释： 有两种方法可以爬到楼顶。
1.  1 阶 + 1 阶
2.  2 阶
示例 2：

输入： 3
输出： 3
解释： 有三种方法可以爬到楼顶。
1.  1 阶 + 1 阶 + 1 阶
2.  1 阶 + 2 阶
3.  2 阶 + 1 阶

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/climbing-stairs
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 * Class Solution
 */
class Solution {

    /**
     * 递归解法，当 n=46 时，结果会溢出。
     * 时间复杂度 2的n次方（递归在该方法体使用了两次，相当于二叉树，树高n-1）
     *
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n)
    {
        if ($n == 1) return 1;
        if ($n == 2) return 2;
        return $this->climbStairs($n-1) + $this->climbStairs($n-2);
    }
    /**
     * 注：像这种递归，用人脑想象，很难模拟出来计算的情形，所以尽量画图，可采用 n 个递归就用 n 叉树的方法
     * 如：这里一个方法体内，用了两个递归方法，所以使用 2叉树 模拟递归的情形
     * 假设 n 为 4
     *                              4
     *                            /   \
     *                          3      2 (命中递归出口，结果为 2)
     *                        /  \
     *                     2（2）  1（1）
     * 所以这里
     * 节点为 3 的递归结果 为 3
     * 节点为 2 的递归结果 为 2
     * 节点为 4 的递归结果 为 5
     */

    /**
     * 循环解法
     * 时间复杂度为 n.
     * 比递归稍微难理解，但是时间复杂度低
     *
     * @param $n
     * @return int
     */
    function climbStairsFor ($n)
    {
        if ($n == 1) return 1; // 只有1阶楼梯时，只有1种走法
        if ($n == 2) return 2; // 只有2阶楼梯时，只有2种走法
        // 设置初始值
        $f1 = 1;
        $f2 = 2;
        $current = 0;
        for ($i = 3; $i <= $n; $i++) { // 注意这里要使用小于等于号
            $current = $f1 + $f2; //当前阶梯数的走法，为前面两个阶梯数的走法之和
            $f1 = $f2; // 更新第 n-2 个阶梯，给下一个循环的第 n 个阶梯使用
            $f2 = $current; // 更新第 n-1 个阶梯，给下一个循环的第 n 个阶梯使用
        }
        return $current;
    }

    /**
     * 动态规划
     * 参考资料：https://mp.weixin.qq.com/s/3h9iqU4rdH3EIy5m6AzXsg
     *
     * @param $n
     * @return mixed
     */
    function climbStairsDynamic ($n)
    {
        // 其实就是上面的 climbStairsFor 方法
        // 动态规划：利用简洁的自底向上的递推方式，实现空间和时间的优化
    }

    /**
     * 备忘录算法1
     * 资料：https://mp.weixin.qq.com/s/3h9iqU4rdH3EIy5m6AzXsg
     *
     * 在递归法基础上做的升级，时间复杂度为 O(n),因为总共n个输入，会有 n-2个命中备忘录结果。
     * 由于引入了类似缓存，所以也可以解决 n=46 时，栈溢出问题
     *
     * @param $n
     * @return int
     */
    public $history = [];
    function climbStairsMemo($n)
    {
        if ($n == 1) return 1;
        if ($n == 2) return 2;

        // 使用全局变量，避免栈递归调用时，变量互相隔离
        if (isset($this->history[$n])) {
            $value = $this->history[$n];
        } else {
            $value = $this->climbStairsMemo($n-1) + $this->climbStairsMemo($n-2);
            $this->history[$n] = $value;
        }
        return $value;
    }

    /**
     * 备忘录算法2：
     * 错误测试：忽略了栈调用时，每次递归的各个变量都是相互隔离的
     * @param $n
     * @return int|mixed
     */
    function climbStairsMemov($n)
    {
        if ($n == 1) return 1;
        if ($n == 2) return 2;

        if (!isset($history) || !is_array($history)) {
//            echo 'u'; // u的数量跟t一致
            $history = [];
        }
        if (isset($history[$n])) {
            //永远不会打印出r。因为$history只是一个局部变量，递归调用此函数，每个递归内的变量都是互不干扰的
//            echo 'r';
            $value = $history[$n];
        } else {
//            echo 't';
            $value = $this->climbStairsMemov($n-1) + $this->climbStairsMemov($n-2);
            $history[$n] = $value;
        }
        return $value;
    }

    /**
     * 备忘录算法3
     *
     * 使用 static ,就可以让变量跳出栈递归的局部变量隔离，成为类似全局变量的静态变量
     * 因为静态变量实在 静态区存储的，而不是栈区。
     *
     * @param $n
     * @return int|mixed
     */
    function climbStairsMemov3($n)
    {
        if ($n == 1) return 1;
        if ($n == 2) return 2;
        static $history = [];
        // 使用全局变量，避免栈递归调用时，变量互相隔离
        if (isset($history[$n])) {
            $value = $history[$n];
        } else {
            $value = $this->climbStairsMemov3($n-1) + $this->climbStairsMemov3($n-2);
            $history[$n] = $value;
        }
        var_dump($history);
        return $value;
    }

    // 针对v3备忘录策略的优化 -- 最细化的缓存策略 -- 当 n=4 时，v3不能命中缓存，v4可以命中1个
    function climbStairsMemov4 ($n)
    {
        if ($n == 1) return 1;
        if ($n == 2) return 2;
        static $history = [];

        if (isset($history[$n-1])) {
            echo 'r';
            $value1 = $history[$n-1];
        } else {
            $value1 = $this->climbStairsMemov4($n-1);
            $history[$n-1] = $value1;
        }
        if (isset($history[$n-2])) {
            $value2 = $history[$n-2];
            echo '命中：p' . $value2 . 'n' . $n;
        } else {
            $value2 = $this->climbStairsMemov4($n-2);
            $history[$n-2] = $value2;
        }
        return $value1 + $value2;
    }

}
$s = new Solution();
echo "递归：" . $s->climbStairs(4) . "\n";
echo "循环：" . $s->climbStairsFor(4) . "\n";
echo "动态规划：" . $s->climbStairsDynamic(4) . "\n";
echo "备忘录算法：" . $s->climbStairsMemo(46) . "\n";
echo "备忘录算法2：" . $s->climbStairsMemov(10) . "\n";
echo "备忘录算法3：" . $s->climbStairsMemov3(4) . "\n";
echo "备忘录算法4：" . $s->climbStairsMemov4(4) . "\n";