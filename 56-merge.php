<?php
/**
 * https://mp.weixin.qq.com/s/Eb6ewVajH56cUlY9LetRJw
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
$intervals =  [[1,4],[2,3]];
$intervals = [[2,3],[4,5],[6,7],[8,9],[1,10]];
$res = mergeV2($intervals);
var_dump($res);

// --------------- v2 ---------------
// 参考：https://mp.weixin.qq.com/s/Eb6ewVajH56cUlY9LetRJw
// 题意：只要相交就合并
function mergeV2($intervals)
{
    if (empty($intervals)) return $intervals;
    // 排序，二维数组根据start排序即可
    $start = [];
    foreach ($intervals as $v) {
        $start[] = $v[0];
    }
    array_multisort($start, SORT_ASC, $intervals);
    // 上一段的最左和最右
    $left = $intervals[0][0];
    $right = $intervals[0][1];
    $cou = count($intervals);
    $res = [];
    $res[] = [$left, $right];
    for ($i = 1; $i < $cou; $i++) {
        if ($right < $intervals[$i][0]) {
            // 不相交
            $left = $intervals[$i][0];
            $right = $intervals[$i][1];
            // 新增结果
            $res[] = [$left, $right];
            continue;
        }
        // 重合了，看看右边值谁大(左边谁小)，取得然后修改到 上一个结果值
        $right = $intervals[$i][1] > $right ? $intervals[$i][1] : $right;
        // 变换值
        $lastIndex = count($res) - 1;
        $res[$lastIndex][1] = $right;
    }
    return $res;
}