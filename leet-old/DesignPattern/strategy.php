<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/5/21
 * Time: 16:35
 * 策略模式
 */

//抽象角色类
abstract class BaseAgent {
    abstract function printPage();
}
// 环境角色类
class IEAgent extends BaseAgent {
    public function printPage () {
        // TODO: Implement printPage() method.
        var_dump('iePAGE');
    }
}

class OtherAgent extends BaseAgent {
    public function printPage () {
        // TODO: Implement printPage() method.
        var_dump('other page');
    }
}

// 具体角色类
class Browser {
    public function call (BaseAgent $object) {
        $object->printPage();
    }
}

// 策略测试
$b = new Browser();
$b->call(new IEAgent());
$b->call(new OtherAgent());


/*
 * 本质是里氏替换原则，用抽象类约束某一个类的方法。
 * 策略模式是对象的行为模式，用意是对一组算法的封装。动态的选择需要的算法并使用。
实现步骤：
    1．定义抽象角色类（定义好各个实现的共同抽象方法）
    2．定义具体策略类（具体实现父类的共同方法）
    3．定义环境角色类（私有化申明抽象角色变量，重载构造方法，执行抽象方法）
 */