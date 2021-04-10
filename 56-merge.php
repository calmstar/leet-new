<?php
/**
 *
 * 输入：intervals = [[1,3],[2,6],[8,10],[15,18]]
输出：[[1,6],[8,10],[15,18]]
解释：区间 [1,3] 和 [2,6] 重叠, 将它们合并为 [1,6].

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/merge-intervals
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/**
 * 先排序，然后判断合并
 * @param $intervals
 * @return array
 */
function merge($intervals)
{
    $cou = count($intervals);
    if ($cou < 2) return $intervals;
    // 取数组的第一个元素进行排序
    $kIntervals = [];
    $keySort = [];
    foreach ($intervals as $k => $v) {
        $keySort[$k] = $v[0];
    }
    asort($keySort);
    foreach ($keySort as $k => $v) {
        $kIntervals[] = $intervals[$k];
    }

    // 对排序好的数组进行判断合并
    $res = [];
    foreach ($kIntervals as $v) {
        if (empty($res)) {
            $res[] = $v;
        }
        $last = end($res);
        if ($last[1] >= $v[0]) {
            // 可以进行合并
            array_pop($res);
            $maxLast = $v[1] > $last[1] ? $v[1] : $last[1];
            $res[] = [$last[0], $maxLast];
        } else {
            $res[] = $v;
        }
    }
    return $res;
}
//$intervals =  [[2,3],[4,5],[6,7],[8,9],[1,10]];
$intervals = [[1,3],[2,6],[8,10],[15,18]];
$intervals = [[2,3],[5,5],[2,2],[3,4],[3,4]];
$res = merge($intervals);
//var_dump($res);