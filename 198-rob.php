<?php
class Solution {

    /**
     * 你是一个专业的小偷，计划偷窃沿街的房屋。每间房内都藏有一定的现金，
     * 影响你偷窃的唯一制约因素就是相邻的房屋装有相互连通的防盗系统，
     * 如果两间相邻的房屋在同一晚上被小偷闯入，系统会自动报警。

    给定一个代表每个房屋存放金额的非负整数数组，计算你 不触动警报装置的情况下 ，一夜之内能够偷窃到的最高金额。

    示例 1：

    输入：[1,2,3,1]
    输出：4
    解释：偷窃 1 号房屋 (金额 = 1) ，然后偷窃 3 号房屋 (金额 = 3)。
         偷窃到的最高金额 = 1 + 3 = 4 。

    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/house-robber
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     */

    /**
     * https://mp.weixin.qq.com/s/z44hk0MW14_mAQd7988mfw
     * @param Integer[] $nums
     * @return Integer
     */
    function rob ($nums) {
        $start = 0;
        return $this->dp($nums, $start);
    }
    private $memo;
    /**
     * 自顶向下的递归式的 动态规划方法
     *  函数定义：
     *      dp[$nums, $start]
     *
     * @param $nums
     * @param $start
     * @return int|mixed
     */
    function dp ($nums, $start) {
        if ($start >= count($nums)) {
            return 0;
        }
        if (isset($this->memo[$start])) return $this->memo[$start];

        $res = max( $this->dp($nums, $start+1),
            $this->dp($nums, $start+2) + $nums[$start] );
        $this->memo[$start] = $res;

        return $res;
    }

    /**
     * 自顶向下的迭代式的 动态规划方法，
     * 对应的索引应该从小到大，由于本题比较特殊，双向都可以，这里用的是索引从大到小
     *
     * @param $nums
     * @return int|mixed
     */
    function robV2 ($nums) {
        $cou = count($nums);

        $dp[$cou] = 0;
        $dp[$cou+1] = 0;
        for ($i = $cou-1; $i >= 0; $i--) {
            $dp[$i] = max( ($nums[$i]+$dp[$i+2]), $dp[$i+1] );
        }
        return $dp[0];
    }

    // v2的内存占用压缩，可以不用数组dp存储。用两个状态就够了 $dp[$i+2]  $dp[$i+1]
    function robV3 ($nums) {
        $cou = count($nums);
        $dp1 = 0;
        $dp2 = 0;
        $dp = 0;
        for ($i = $cou-1; $i >= 0; $i--) {
            $dp = max( ($nums[$i]+$dp2), $dp1 );
            $dp2 = $dp1;
            $dp1 = $dp;
        }
        return $dp;
    }

    // ---------下面是自己想的，标准的 自底向上对应索引从小到大； 自顶向下对应索引从大到小 ------

    /**
     * [1,2,3,1] 4
     * 状态机思想：
     *
     * 状态：索引位置
     * 选择：抢或不抢
     *      dp[状态...] = operate(选择1, 选择2)
     *      dp[索引] = max(抢，不抢)
     *
     * 定义：dp[i] 代表在i位置能抢到的最大金额
     * baseCase： dp[1] = nums[1]
     * 状态转移方程： dp[i] = max(dp[i-1], dp[i-2] + nums[i])
     *
     * @param $nums
     * @return int|mixed
     */
    function robV4 ($nums)
    {
        $cou = count($nums);
        if (empty($nums)) return 0;
        if ($cou == 1) return $nums[0] ;
        if ($cou == 2) return max($nums[0], $nums[1]);

        $dp = [];
        $dp[0] = $nums[0];
        $dp[1] = max($nums[0], $nums[1]);
        for ($i = 2; $i < $cou; $i++) {
            $dp[$i] = max(
                $dp[$i-1], // 选择1：不抢当前金额
                $dp[$i-2] + $nums[$i] // 选择2：抢当前金额
            );
        }
        return $dp[$cou-1];
    }

    // v4的压缩变量
    function robV5 ($nums)
    {
        if (empty($nums)) return 0;
        $cou = count($nums);
        $dp1 = $nums[0];
        $dp2 = max($nums[0], $nums[1]);

        $res = 0;
        for ($i = 2; $i < $cou; $i++) {
            $res = max( $dp1, $dp2 + $nums[$i] );

            $dp2 = $dp1;
            $dp1 = $res;
        }
        return $res;
    }

    /**
     * [1,2,3,1]  4
     * 函数定义：
     *      function dp($nums, $i) 代表数组nums在i位置能抢到的最大金额
     * baseCase
     *      if ($i == 0) return $nums[0]
     *      if ($i == 1) return max($nums[0], $nums[1])
     * 状态转移：
     *      function dp($nums, $i)
     *          return max(
                    $this->dp($nums, $i-1), // 不抢
                    $this->dp($nums, $i-2) + $nums[$i] // 抢
     *          )
     *
     * @param $nums
     * @return int|mixed|void
     */
    function robV6 ($nums)
    {
        $cou = count($nums);
        if (empty($nums)) return 0;
        if ($cou == 1) return $nums[0] ;
        if ($cou == 2) return max($nums[0], $nums[1]);
        return $this->dpV6($cou-1, $nums);
    }
    private $memoV6 = [];
    function dpV6 ($i, $nums)
    {
        if (isset($this->memoV6[$i])) return $this->memoV6[$i];
        if ($i == 0) return $nums[0];
        if ($i == 1) return max($nums[0], $nums[1]);

        $this->memoV6[$i] = max(
            $this->dpV6( $i-1, $nums), // 不抢
            $this->dpV6( $i-2, $nums) + $nums[$i] // 抢
        );
        return $this->memoV6[$i];
    }

}
$nums = [1,2,3,1];
$res = (new Solution())->robV6($nums);
var_dump($res);