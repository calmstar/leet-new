<?php
class CQueue {

    private $stack = [];
    /**
     */
    function __construct() {

    }

    /**
     * @param Integer $value
     * @return NULL
     */
    function appendTail($value) {
        array_push($this->stack, $value);
    }

    /**
     * @return Integer
     */
    function deleteHead() {
        $res = array_shift($this->stack);
        return $res ?? -1;
    }
}

/**
 * Your CQueue object will be instantiated and called as such:
 * $obj = CQueue();
 * $obj->appendTail($value);
 * $ret_2 = $obj->deleteHead();
 */