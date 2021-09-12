<?php

/**
 * PHP工厂模式概念：工厂模式是一种类，它具有为您创建对象的某些方法。您可以使用工厂类创建对象，而不直接使用 new。这样，
 * 如果您想要更改所创建的对象类型，只需更改该工厂即可。使用该工厂的所有代码会自动更改。
 *
    根据抽象程度不同，php工厂模式分为：简单工厂模式、工厂方法模式和抽象工厂模式
 *
 *  简单工厂模式： 用来生产同一等级结构中的任意产品。对与增加新的产品，无能为力
 * 工厂方法模式：用来生产同一等级结构中的固定产品。（支持增加任意产品）
 * 抽象工厂 ：用来生产不同产品族的全部产品。（对于增加新的产品，无能为力；支持增加产品族）
 *
 * https://www.cnblogs.com/banye/p/7086770.html
 *
 */


// ------------- 简单工厂模式 -------------------
/**
 *简单工厂模式
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

class SimpleFactoty {
    public static function createMan() {
        return new  man();
    }
    public static function createWomen() {
        return new women();
    }
}

$man = SimpleFactoty::createMan();
$man->jiehun();
$man = SimpleFactoty::createWomen();
$man->jiehun();









