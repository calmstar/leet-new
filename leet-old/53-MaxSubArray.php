<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/17
 * Time: 14:14
 */


/**
 * 给定一个整数数组 nums ，找到一个具有最大和的连续子数组（子数组最少包含一个元素），返回其最大和。

示例:

输入: [-2,1,-3,4,-1,2,1,-5,4],
输出: 6
解释: 连续子数组 [4,-1,2,1] 的和最大，为 6。
进阶:

如果你已经实现复杂度为 O(n) 的解法，尝试使用更为精妙的分治法求解。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/maximum-subarray
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 * Class Solution
 */

class Solution {

    /**
     * star 双层for循环，没什么算法技巧可言。但是可以精确得出 具体索引 位置
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $cou = count($nums);
        if ($cou == 1) return $nums[0];

        // 第一个 for 循环对应第1...n个数字
        $MaxOfAll = $nums[0];  // 历史最大数字
        for ($i = 0; $i < $cou; $i++) {
            $sum = $nums[$i];
            $max = $nums[$i];

            // 第二个 for 循环对应
            // 第1个数字 依次跟后面的数字相加，得出的最大值；
            // 第2个数字，依次跟后面的数字相加,得出的最大值；
            // 第3个数字，...
            for ($j = $i+1; $j < $cou; $j++) {
                $sum += $nums[$j];
                if ($sum > $max) {
                    $max = $sum;
                }
            }

            // 将此数字最大的，跟历史最大的数字相比较，保留得到新的 最大的数字
            if ($max > $MaxOfAll) {
                $MaxOfAll = $max;
            }
        }
        return $MaxOfAll;
    }


    // 贪心算法，有技巧可言
    // [-2,1,-3,  4,-1,2,1  ,-5,4],
    function maxSubArrayExample ($nums) {
        $maxNum = $nums[0];                             // 最大和先记为数组第一个数；
        $tmp = $nums[0];                                // 子串序列和，从第一个数开始；

        foreach($nums as $k => $v){
            if($k === 0){                               // 因为数组第一个数已经取出，所以跳过；
                continue;
            }

            if($tmp > 0){                               // 如果（子串序列和）大于0，说明此时子串序列可以继续往后加；
                $tmp = $tmp + $v; //   $tmp=5                  // 子串继续 + 下个数
            }else{
                $tmp = $v;    // $tmp=4                        // 如果（子串序列和）小于0，则当前位置开始取新的（子串序列和）。小于0即为负数，加到后面数字反而更小
            }
            //$maxNum = max([$maxNum,$tmp]);              // 把当前最大值（$maxNum），和当前（字串序列和$tmp）比，取最大值
            $maxNum = $maxNum > $tmp ? $maxNum : $tmp; //$maxNum=6    // 三目运算比上面的内置函数快；
        }
        return $maxNum;
    }


}

$nums = [-2,1,-3,4,-1,2,1,-5,4];
$solution = new Solution();
$res = $solution->maxSubArrayExample($nums);
var_dump($res);
