<?php
//$graph = [
//    'A' => ['B', 'C'],
//    'B' => ['A', 'C', 'D'],
//    'C' => ['A', 'B', 'D', 'E'],
//    'D' => ['B', 'C', 'E', 'F'],
//    'E' => ['C', 'D'],
//    'F' => ['D'],
//];
//
//function BFSFindParent ($graph, $start)
//{
//    // 起始节点没有父节点
//    $parentNodeArr = [$start => ''];
//    $queue = [];
//    $dealed = [];
//    array_push($queue, $start);
//    while (!empty($queue)) {
//        $node = array_shift($queue);
//        $dealed[] = $node;
//        $neighborArr = $graph[$node];
//        foreach ($neighborArr as $v) {
//            if (!in_array($v, $queue) && !in_array($v, $dealed)) {
//                array_push($queue, $v);
//                $parentNodeArr[$v] = $node;
//            }
//        }
//    }
//    return $parentNodeArr;
//}
//
//$parentNodeArr = BFSFindParent($graph,'A');
//$end = 'F';
//$way = $end;
//while (!empty($parentNodeArr[$end])) {
//    $way = $parentNodeArr[$end] .  '->' .  $way;
//    $end = $parentNodeArr[$end];
//}
//echo $way;


/**
 * Class A
 */
class A {
    public $val;
    public $next;
    public function __construct($val)
    {
        $this->val = $val;
    }
}
// 将对象变量a赋值给其他变量b后，通过对象变量b更改属性，那么对象变量a的属性也会改变
$a = new A(3);
$b = $a;
$b->val = 2;
$a->val = 4;
var_dump($a, $b);
/**
 * 上面运行的结果
 * object(A)#1 (2) {
["val"]=>
int(4)
["next"]=>
NULL
}
object(A)#1 (2) {
["val"]=>
int(4)
["next"]=>
NULL
}
 */

echo "----------\n";

// 将对象变量aa赋值克隆给其他变量bb后，通过对象变量bb更改属性，那么对象变量aa的属性 不会 改变
$aa = new A(33);
$bb = clone $aa;
$bb->val = 44;
var_dump($aa, $bb);
/**
 * 上面运行的结果：
 * object(A)#2 (2) {
["val"]=>
int(33)
["next"]=>
NULL
}
object(A)#3 (2) {
["val"]=>
int(44)
["next"]=>
NULL
}

 */
