<?php

/**
 * 注册树模式
 */
class register {
    protected static $objects;

    public static function set($alias, $object) {
        self::$objects[$alias] = $object;
    }

    public static function unset($alias) {
        unset(self::$objects[$alias]);
    }

    public static function get($alias) {
        return self::$objects[$alias];
    }
}

register::set('name', 'wenxing');
var_dump(register::get('name'));
register::unset('name');
var_dump(register::get('name'));



/**
 * 注册模式，解决全局共享和交换对象。已经创建好的对象，挂在到某个全局可以使用的数组上，
 * 在需要使用的时候，直接从该数组上获取即可。将对象注册到全局的树上。任何地方直接去访问。
 */