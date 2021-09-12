<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/2/20
 * Time: 12:29
 */

/*
 * php 实现一个单链表
 *
 * 单链表，节点只有一个指针域的链表。节点包括数据域和指针域。

　　因此用面向对象的思维，节点类的属性就有两个：一个data（表示存储的数据），一个指针next（链表中指向下一个节点）。

　　链表一个很重要的特性，就是这个头节点$head。它绝对不能少，每次遍历都要从它开始，并且不能移动头节点.
 */

class Node{
    public $data = '';
    public $next = null;
    function __construct($data)
    {
        $this->data = $data;
    }
}


// 链表有几个元素
function countNode($head){
    $cur = $head;
    $i = 0;
    while(!is_null($cur->next)){
        ++$i;
        $cur = $cur->next;
    }
    return $i;
}

// 增加节点
function addNode($head, $data){
    $cur = $head;
    while(!is_null($cur->next)){
        $cur = $cur->next;
    }
    $new = new Node($data);
    $cur->next = $new;

}

// 紧接着插在$no后
function insertNode($head, $data, $no){
    if ($no > countNode($head)){
        return false;
    }
    $cur = $head;
    $new = new Node($data);
    for($i=0; $i<$no;$i++){
        $cur = $cur->next;
    }
    $new->next = $cur->next;
    $cur->next = $new;

}

// 删除第$no个节点
function delNode($head, $no){
    if ($no > countNode($head)){
        return false;
    }
    $cur = $head;
    for($i=0; $i<$no-1; $i++){
        $cur = $cur->next;
    }
    $cur->next = $cur->next->next;

}

// 遍历链表
function showNode($head){
    $cur = $head;
    while(!is_null($cur->next)){
        $cur = $cur->next;
        echo $cur->data, '<br/>';
    }
}

$head = new Node(null);// 定义头节点

addNode($head, 'a');
addNode($head, 'b');
addNode($head, 'c');

insertNode($head, 'd', 0);

showNode($head);

echo "\n";

delNode($head, 2);

showNode($head);