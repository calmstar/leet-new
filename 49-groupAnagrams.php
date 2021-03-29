<?php

//字母异位词分组
/**
 *  * 给定一个字符串数组，将字母异位词组合在一起。字母异位词指字母相同，但排列不同的字符串。
 * 输入: ["eat", "tea", "tan", "ate", "nat", "bat"]
输出:
[
["ate","eat","tea"],
["nat","tan"],
["bat"]
]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/group-anagrams
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

//php的sort函数在元素数 较小(16个及以下)的时候，使用插入排序，否则使用非递归的快速排序来进行排序。
/**
 *
 * 数组长度为n, 最长的字符长度为m
    时间复杂度：O (n * mlgm)
 * 空间复杂度： O (n)
 * @param $strs
 */
function groupAnagrams($strs)
{
    if (count($strs) < 2) return $strs;
    $res = [];
    foreach ($strs as $v) {
        // 将字符转成数组
        $temp = str_split($v);
        sort($temp);
        $val = implode('', $temp);

        $res[$val][] = $v;
    }
    return $res;
}
