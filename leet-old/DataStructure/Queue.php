<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/11
 * Time: 11:22
 */



/**
 * 这里使用数组做一个简单的演示，表示下队列 先进先出 的特性
 */
echo "==== 方式一 ====\n";
$queue = [1, 2, 3, 4, 5];
echo "原有数组元素：\n";
var_dump($queue);

// 入队
array_push($queue, 6);
echo "入队：\n";
var_dump($queue);

// 出队
$cou = count($queue);
for ($i = 0; $i < $cou; $i++) {
    $unit = array_shift($queue);
    echo "出队：{$unit}\n";
}

echo "==== 方式二 ====\n";
$spl = new SplQueue();
$spl->enqueue(1);
$spl->enqueue(2);
$spl->enqueue(3);
echo "出队\n";
echo $spl->dequeue() . "\n"; // 1
echo $spl->dequeue() . "\n"; // 2