<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/1/20
 * Time: 11:31
 */

/**
 * 给定一个排序数组，你需要在原地删除重复出现的元素，使得每个元素只出现一次，返回移除后数组的新长度。

不要使用额外的数组空间，你必须在原地修改输入数组并在使用 O(1) 额外空间的条件下完成。

示例 1:

给定数组 nums = [1,1,2],

函数应该返回新的长度 2, 并且原数组 nums 的前两个元素被修改为 1, 2。

你不需要考虑数组中超出新长度后面的元素。
示例 2:

给定 nums = [0,0,1,1,1,2,2,3,3,4],

函数应该返回新的长度 5, 并且原数组 nums 的前五个元素被修改为 0, 1, 2, 3, 4。

你不需要考虑数组中超出新长度后面的元素。
说明:

为什么返回数值是整数，但输出的答案是数组呢?

请注意，输入数组是以“引用”方式传递的，这意味着在函数里修改输入数组对于调用者是可见的。

你可以想象内部操作如下:

// nums 是以“引用”方式传递的。也就是说，不对实参做任何拷贝
int len = removeDuplicates(nums);

// 在函数里修改输入数组对于调用者是可见的。
// 根据你的函数返回的长度, 它会打印出数组中该长度范围内的所有元素。
for (int i = 0; i < len; i++) {
    print(nums[i]);
}

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/remove-duplicates-from-sorted-array
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */
class Solution {

    /**
     * 1 将数组的一个元素与后一个元素相比较，如果一样，则记录该数组的索引
        2 将要去处的数组索引遍历unset
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums) {
        // [1,1,2]
        $num = count($nums);
        if ($num <= 1) return $num;

        $unsetIndexArr = [];
        for ($i = 0; $i < $num; $i++) {
            if ($i+1 >= $num) break;
            if ($nums[$i] == $nums[$i+1]) { // 题意为有序数组
                $unsetIndexArr[] = $i+1;
            }
        }
        foreach ($unsetIndexArr as $v) {
            unset($nums[$v]);
        }
        return count($nums);
    }

    /**
     * leetcode 官方双指针用法
     * @param $nums
     * @return int
     */
    function removeDuplicatesOfficial (&$nums)
    {
        // [1,1,2]
        $num = count($nums);
        if ($num <= 1) return $num;

        // $j慢指针，指向不重复的数据；$i为快指针，指向全体数据
        $j = 0;
        for ($i = 1; $i < $num; $i++) {
            if ($nums[$j] != $nums[$i]) { // 题意:有序数组
                // 不等，则慢指针偏移。将快指针的数据，拷贝到下一个慢指针的数据（不重复）
                $j++;
                $nums[$j] = $nums[$i]; // 题意:你不需要考虑数组中超出新长度后面的元素
            } else {
                // 相等，则慢指针不偏移。
                // 快指针跳过该重复的元素
                continue;
            }
        }
        return $j+1;
    }
}
$arr = [1,1,2];
$s = new Solution();

echo "我的解法\n";
var_dump($s->removeDuplicates($arr));

echo "官方解法\n";
var_dump($s->removeDuplicatesOfficial($arr));