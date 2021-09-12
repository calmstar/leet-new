<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/1
 * Time: 17:29
 */

/**
 * 参考资料：https://www.bilibili.com/video/av25763384/?spm_id_from=trigger_reload
 *
 * 深度优先搜索
 * Depth First Search
 *      需要借助 栈 这种数据结构： 因为深度遍历，需要层层递进，邻居节点很快就要用到，所以放入栈中，后进先出
 *
 * 注：深度优先搜索，对树来说，就是前、中、后序遍历
 */

$graph = [
    'A' => ['B', 'C'],
    'B' => ['A', 'C', 'D'],
    'C' => ['A', 'B', 'D', 'E'],
    'D' => ['B', 'C', 'E', 'F'],
    'E' => ['C', 'D'],
    'F' => ['D'],
];

/**
 * 深度遍历图，并打印出节点值
 * @param $graph
 * @param $start
 */
function DFS ($graph, $start)
{
    $stack = [$start];
    $dealed = [$start];
    while (count($stack) > 0) {
        $point = array_pop($stack);
        $neighborPoint = $graph[$point];
        foreach ($neighborPoint as $v) {
            if (!in_array($v, $dealed)) {
                array_push($stack, $v);  // 跟 bfs 的区别就是: 这里使用的是push, bfs用的是 array_unshift
                array_push($dealed, $v);
            }
        }
        echo $point . "\n";
    }
}

DFS($graph, 'A');
/*
A
C
E
D
F
B
 */