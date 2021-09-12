<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07/03/2017
 * Time: 21:35
 */

/**
 * 模拟一个栈单元的数据结构
 * Class node
 */
class node{
    private $value;
    private $pre;
    public function __construct($value){
        $this->value = $value;
        $this->pre = null;
    }
    public function addPre($node){
        $this->pre = $node;
    }
    public function getPre(){
        return $this->pre;
    }
    public function getValue(){
        return $this->value;
    }
}

/**
 * 实现一个栈的操作
 * Class stack
 */
class stack{
    private $top;
    static public $size;
    public function __construct($value){
        $this->top = new node($value);
    }

    public function push($value){
        $current = $this->top;
        $newNode = new node($value);
        $newNode->addPre($current);
        $this->top = $newNode;
    }

    public function getAllStack(){
        $stack = null;
        $current = $this->top;
        while ($current->getPre() != null){
            $stack .= $current->getValue()."\n";
            $current = $current->getPre();
        }
        return $stack;
    }

    public function getSize(){
        $current = $this->top;
        while (null != $current->getValue()){
            self::$size++;
            $current = $current->getPre();
        }
        return self::$size;
    }

    public function pop(){
        $current = $this->top;
        $this->top = $current->getPre();
        unset($current);
    }

    public function getTop(){
        return $this->top->getValue();
    }
}
echo  "===== 方式一 =====\n";
$stack = new stack(0);
$stack->push(1);
$stack->push(2);
$stack->push(3);
$stack->push(4);
$stack->push(5);
$stack->push(6);
$stack->push('a');
$stack->push('b');
$stack->push('c');
$stack->push('d');
echo "无出栈顺序:".$stack->getAllStack()."\n";
$stack->pop();
$stack->pop();
$stack->pop();
echo "三次出栈后:".$stack->getAllStack()."\n";
echo "此时的栈顶元素:".$stack->getTop()."\n";
echo "栈的长度为:".$stack->getSize()."\n";

/**
 * 方式二：使用php内置函数：array_push(),array_pop(),array_unshift(),array_shift()
 * https://www.cnblogs.com/clubs/p/11949578.html(此链接关于队列的描述举例错误了)
 */
echo  "===== 方式二.1 =====\n";
$rangeList = array("淘宝", "天猫", " VIP");
//入栈
array_push($rangeList, "拼多多");
array_push($rangeList, "JD");
var_dump($rangeList);//array(5) { [0]=> string(6) "淘宝" [1]=> string(6) "天猫" [2]=> string(4) " VIP" [3]=> string(9) "拼多多" [4]=> string(2) "JD" }

//出栈
$result = array_pop($rangeList);//JD
var_dump($result);
$result = array_pop($rangeList);//拼多多
var_dump($result);

/**
 * 上面是使用 array_push和 array_pop 对数组索引尾部使用;
 * 也可以使用 array_shift  和 array_unshift 对数组索引头部进行使用；
 * 无论是头部还是尾部，都是一个相对的概念，只要能够满足 先进后出 的特点就是栈
 */
echo  "===== 方式二.2 =====\n";
$stack = array("三星", "LG", "惠而浦");
//入队
array_unshift($stack, "海信");
array_unshift($stack, "科龙");
var_dump($stack); //array(5) { [0]=> string(6) "科龙" [1]=> string(6) "海信" [2]=> string(6) "三星" [3]=> string(2) "LG" [4]=> string(9) "惠而浦" }
//出队
$res = array_shift($stack);//科龙
var_dump($res);
$res = array_shift($stack);//海信
var_dump($res);

/**
 * 方式二：使用 SplStack 类 实现栈
 * https://www.jianshu.com/p/8a83ec29c3e4
 */
echo "==== 方式三 ====\n";
$books = new SplStack();
$books->push("111");
$books->push("222");
$books->push("333");
echo $books->pop() . "\n"; // 333
echo $books->pop() . "\n"; // 222
