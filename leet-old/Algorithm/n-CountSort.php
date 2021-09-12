<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/5
 * Time: 18:44
 */


// 对数组进行排序
//$arr = [1,3,3,2];
$arr = [30, 22, 37, 22];
/**
 * 计数排序：适用于数据量大，但取值范围小的数组
 *
 * 计数排序的两个问题：
 *              1 开始索引距离0很远 -- 在PHP中不存在这种情况，因为PHP的数组可以不从0开始，本质是哈希表。（其他语言，可以用偏移量解决）
 *              2 不是稳定的排序 （相同值的两个数的位置，可能会发生变化） -- 解决：对计数数组进行累加，然后把数组从后往前遍历
 *
 * @param $arr
 * @param $min
 * @param $max
 * @return mixed
 */
function countSort ($arr, $min, $max)
{
    $countArr = [];
    foreach ($arr as $k => $v) {
        if (!isset($countArr[$v])) {
            $countArr[$v] = 1; // 将要排序数组的值，当作key，存入计数数组中，并记录出现的次数
        } else {
            $countArr[$v]++;
        }
    }

    $z = 0;
    for ($i = $min; $i <= $max; $i++) {
        if (!isset($countArr[$i])) continue; // 由于上面只初始化了 $min-$max 的部分数据，所以要加个判断
        while ($countArr[$i]-- > 0) {
            $arr[$z++] = $i; // 继续使用 $arr , 减少内存空间开销
        }
    }
    return $arr;
}
var_dump(countSort($arr,22, 37));

echo "\n========== 以上为不稳定计数排序，下面为稳定计数排序 ===== \n\n" ;
/**
 * 计数排序 -- 升级 -- 稳定排序
 * 由于最后得出结果数组是，遍历原数组得到的，所以不需要知道 $min 和 $max
 *
 * 可以假设： [0, 1, 0, 2, 2, 0, 1, 1, 1, 1]
 *  出现的数字：  [0, 1, 2] --> arr
 *  数字出现次数：[0=>3, 1=>5, 2=>2] --> countArr，数字0出现三次，数字1五次...
 *  累计数组：   [0=>3, 1=>8, 2=>10] --> countArr(sumSort) ,代表数字2的位置从第十个位置开始（索引9）开始往前存储...
 *
 * @param $arr
 * @param $min
 * @param $max
 * @return array
 */
function countSortStable ($arr, $min, $max)
{
    // 还是先得到计数数组
    $countArr = [];
    foreach ($arr as $v) {
        if (isset($countArr[$v])) {
            $countArr[$v]++;
        } else {
            $countArr[$v] = 1;
        }
    }

    // $countArr 里的key顺序决定放数字的顺序。因为上面是通过foreach,所以key可能不是按照顺序来，需要先排好序
    ksort($countArr);
    $temp = 0;
    foreach ($countArr as $k => $v) {
//        if (!isset($countArr[$k-1])) continue; // 不能是 $k-1， 因为$k可能不是连续的（像3，4，6）
        $countArr[$k] += $temp;
        $temp = $countArr[$k];
    }

    // 将 累加数组 进行运用
    $resArr = [];
    $cou = count($arr);
    for ($i = $cou-1; $i >= 0; $i--) {
        $index = --$countArr[$arr[$i]]; // 得到该数值对应的存储位置
        $resArr[$index] = $arr[$i];
    }
    ksort($resArr); // 由于PHP不会让索引从0开始，所以这里需要对索引排序好
    return $resArr;
}
//
$stableArr = [0, 1, 0, 2, 2, 0, 1, 1, 1, 1];
$res = countSortStable($stableArr, 0, 0);
var_dump($res);


echo "\n========== 以上为练习，下面为网上范例 ===== \n\n" ;

/**
 * 计数排序：适用于数据量大，但取值范围小的数组
 * @param $my_array
 * @param $min
 * @param $max
 * @return mixed
 */
function counting_sort($my_array, $min, $max)
{
    $count = array();
    for ($i = $min; $i <= $max; $i++) {
        $count[$i] = 0;
    }
    foreach ($my_array as $number) {
        $count[$number]++; // 把要排序的数组$my_array的值，取出来作为新数组$count的key
    }
    $z = 0;
    for ($i = $min; $i <= $max; $i++) {
        while ($count[$i]-- > 0) {
            $my_array[$z++] = $i; // 将 key 对应的值和次数依次取出，就得到排序好的数组
        }
    }
    return $my_array;
}

$test_array = array(3, 0, 2, 5, -1, 4, 1);
echo "原始数组 :\n";
echo implode(', ', $test_array);
echo "\n排序后数组:\n";
echo implode(', ', counting_sort($test_array, -1, 5)) . PHP_EOL;


