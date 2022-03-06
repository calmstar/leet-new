<?php
class Solution {

    /**
     * 你是一个专业的小偷，计划偷窃沿街的房屋。每间房内都藏有一定的现金，影响你偷窃的唯一制约因素就是相邻的房屋装有相互连通的防盗系统，如果两间相邻的房屋在同一晚上被小偷闯入，系统会自动报警。

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
    // 想到baseCase该怎么做
    // 明确选择和状态
    // 状态转移方程，dp[i] = max( num[i] + dp[i+2], dp[i+1])
    //  $num从$start到数组末尾 的最大收益为 dp ($nums, $start)
    //  自顶向下的递归式的 动态规划方法
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

    // 自底向上的迭代式的 动态规划方法
    function robV2 ($nums) {
        $cou = count($nums);

        $dp[$cou] = 0;
        $dp[$cou+1] = 0;
        for ($i = $cou-1; $i >= 0; $i--) {
            $dp[$i] = max( ($nums[$i]+$dp[$i+2]), $dp[$i+1] );
        }
        return $dp[0];
    }

    // 内存占用压缩，可以不适用数组dp存储.
    // 用两个状态就够了 $dp[$i+2]  $dp[$i+1]
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

}