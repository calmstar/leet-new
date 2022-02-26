<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/fIKhhDSNdtun87WhaPhoQQ
     *
     * 输入：nums = [-4,-1,0,3,10]
    输出：[0,1,9,16,100]
    解释：平方后，数组变为 [16,1,0,9,100]
    排序后，数组变为 [0,1,9,16,100]

    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/squares-of-a-sorted-array
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     */

    /**
     *
     * 有序数组的平方
     * 双指针法 ： O(N)
     * @param Integer[] $nums
     * @return Integer[]
     */
    function sortedSquares($nums)
    {
        $cou = count($nums);
        if (empty($cou)) return $nums;
        $res = [];
        $head = 0;
        $last = $cou-1;
        $k = $cou-1;
        for ($i = 0; $i <= $k; $i++) {
            $res[$i] = 0;
        }
        while ($head <= $last) {
            $tmpHead = $nums[$head] * $nums[$head];
            $tmpLast = $nums[$last] * $nums[$last];
            if ($tmpHead > $tmpLast) {
                $res[$k] = $tmpHead;
                $head++;
            } else {
                $res[$k] = $tmpLast;
                $last--;
            }
            $k--;
        }
        return $res;
    }

    function practice ($nums)
    {
        $cou = count($nums);
        if ($cou == 0) return [];
        $res = [];
        $resPoint = $cou - 1;
        $startPoint = 0;
        $endPoint = $cou - 1;
        for ($i = 0; $i <= $resPoint; $i++) {
            $res[$i] = 0;
        }
        while ($startPoint <= $endPoint) {
            $startRes = $nums[$startPoint] * $nums[$startPoint];
            $endRes = $nums[$endPoint] * $nums[$endPoint];
            if ($startRes < $endRes) {
                $res[$resPoint] = $endRes;
                $endPoint--;
            } else {
                $res[$resPoint] = $startRes;
                $startPoint++;
            }
            $resPoint--;
        }
        return $res;

    }
}

$nums = [-4,-1,0,3,10];
$res = (new Solution())->sortedSquares($nums);
//$res = (new Solution())->practice($nums);
print_r($res);


