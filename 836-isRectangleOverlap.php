<?php
class Solution {

    /**
     *
     * 矩形以列表 [x1, y1, x2, y2] 的形式表示，其中 (x1, y1) 为左下角的坐标，(x2, y2) 是右上角的坐标。
     * 矩形的上下边平行于 x 轴，左右边平行于 y 轴。
    给出两个矩形 rec1 和 rec2 。如果它们重叠，返回 true；否则，返回 false 。
    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/rectangle-overlap
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     * @param Integer[] $rec1
     * @param Integer[] $rec2
     * @return Boolean
     */
    function isRectangleOverlap($rec1, $rec2) {
        // 不重叠的情况
        if ($rec2[2] <= $rec1[0] || $rec2[0] >= $rec1[2] || $rec2[1] >= $rec1[3] || $rec2[3] <= $rec1[1] ) {
            return false;
        }
        return true;
    }
}