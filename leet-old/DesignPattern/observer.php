<?php

/**
 * 观察者模式
 */
abstract class EventGenerator {
    private $observers = array();

    public function addObserver(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

interface Observer {
    function update();//这里就是在事件发生后要执行的逻辑
}

class Event extends EventGenerator {
    function triger() {
        var_dump('event');
    }
}

// 具体观察者
class Observer1 implements Observer {
    function update() {
        var_dump('逻辑1');
    }
}

class Observer2 implements Observer {
    function update() {
        var_dump('逻辑2');
    }
}

$event = new Event();
$event->addObserver(new Observer1());
$event->addObserver(new Observer2());
$event->triger(); //事件被触发
$event->notify();



/**
 *
 * 本质是利用数组存入需要被通知的对象（该对象要预先写好事件发生的逻辑）
 *
 * 1：观察者模式(Observer)，当一个对象状态发生变化时，依赖它的对象全部会收到通知，并自动更新。
 * 2：场景:一个事件发生后，要执行一连串更新操作。传统的编程方式，就是在事件的代码之后直接加入处理的逻辑。当更新的逻辑增多之后，代码会变得难以维护。这种方式是耦合的，侵入式的，增加新的逻辑需要修改事件的主体代码。
 * 3：观察者模式实现了低耦合，非侵入式的通知与更新机制。
 * 定义一个事件触发抽象类。
 */