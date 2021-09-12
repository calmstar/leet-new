<?php
/**
 * 单例模式
 */

class Single {
    private static $instance;

    private function __clone() {
    }

    private function __construct() {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

$s = Single::getInstance();
$ss = Single::getInstance();
var_dump($s === $ss); // true

/**
 * 单例模式确保某个类只有一个实例，而且自行实例化并向整个系统提供这个实例。
 * 单例模式是一种常见的设计模式，在计算机系统中，线程池、缓存、日志对象、对话框、打印机、数据库操作、显卡的驱动程序常被设计成单例。
 * 单例模式分3种：懒汉式单例、饿汉式单例、登记式单例。
 * 单例模式有以下3个特点：
 * 1．只能有一个实例。
 * 2．必须自行创建这个实例。
 * 3．必须给其他对象提供这一实例。
 * 那么为什么要使用PHP单例模式？
 * PHP一个主要应用场合就是应用程序与数据库打交道的场景，在一个应用中会存在大量的数据库操作，针对数据库句柄连接数据库的行为，
 * 使用单例模式可以避免大量的new操作。因为每一次new操作都会消耗系统和内存的资源。
 */