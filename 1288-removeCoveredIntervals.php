<?php


/**
 * https://mp.weixin.qq.com/s/Eb6ewVajH56cUlY9LetRJw
 * 注意画图
 *
 * 删除被覆盖区间
 *
 * 给你一个区间列表，请你删除列表中被其他区间所覆盖的区间。
只有当 c <= a 且 b <= d 时，我们才认为区间 [a,b) 被区间 [c,d) 覆盖。
在完成所有删除操作后，请你返回列表中剩余区间的数目。
 *
示例：
输入：intervals = [[1,4],[3,6],[2,8]]
输出：2
解释：区间 [3,6] 被区间 [2,8] 覆盖，所以它被删除了。

 */
class Solution {

    /**
     * @param Integer[][] $intervals
     * @return Integer
     */
    function removeCoveredIntervals($intervals)
    {
        if (empty($intervals)) return 0;
        // 对二维数组进行排序：先按子数组的start升序排列，再对end降序排列
        $start = [];
        $end = [];
        foreach ($intervals as $v) {
            $start[] = $v[0];
            $end[] = $v[1];
        }
        array_multisort($start, SORT_ASC, $end, SORT_DESC, $intervals);

        // 循环判断三种情况并处理
        // left和right表示上一个区间的最左边和最右边
        $cou = count($intervals);
        $left = $intervals[0][0];
        $right = $intervals[0][1];
        $res = 0;
        for ($i = 1; $i < $cou; $i++) {
            // 1 覆盖
            if ($left <= $intervals[$i][0] && $right >= $intervals[$i][1]) {
                $res++;
            }
            // 2 相交
            if ($left <= $intervals[$i][0] && $intervals[$i][0] <= $right && $intervals[$i][1] > $right) {
                $right = $intervals[$i][1];
            }
            // 3 无相交
            if ($intervals[$i][0] > $right) {
                $left = $intervals[$i][0];
                $right = $intervals[$i][1];
            }
        }
        return $cou-$res;
    }

}
$data = array(
    array(1,2),
    array(3,4),
    array(3,6)
);
$data = [[0,10],[5,12]];
$data = [[1,2],[1,4],[3,4]];
$res = (new Solution())->removeCoveredIntervals($data);
var_dump($res);
