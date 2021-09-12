<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/19
 * Time: 16:09
 */

/**
 * 普通工厂模式
 *
 *工厂方法模式：
 *定义一个创建对象的接口，让子类决定哪个类实例化。 他可以解决简单工厂模式中的封闭开放原则问题。<www.phpddt.com整理>
 */
interface  people {
    function  jiehun();
}
class man implements people{
    function jiehun() {
        echo '男';
    }
}

class women implements people {
    function jiehun() {
        echo '女';
    }
}

interface  createMan {  // 注意了，这里是简单工厂本质区别所在，将对象的创建抽象成一个接口。
    function create();

}
class FactoryMan implements createMan{
    function create() {
        return  new man;
    }
}
class FactoryWomen implements createMan {
    function create() {
        return new women;
    }
}

// 测试类
class  Client {
    // 简单工厂里的静态方法
    function test() {
        $Factory =  new  FactoryMan;
        $man = $Factory->create();
        $man->jiehun();

        $Factory =  new  FactoryWomen;
        $man = $Factory->create();
        $man->jiehun();
    }
}

$f = new Client;
$f->test();

