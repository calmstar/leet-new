<?php
class MinStack {

    private $minStack; // 最小栈，保持栈顶永远为最小元素
    private $stack;
    /**
     * initialize your data structure here.
     */
    function __construct() {
        $this->stack = [];
        $this->minStack = [];
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        array_push($this->stack, $x);
        // 操作最小栈
        if (empty($this->minStack)) {
            array_push($this->minStack, $x);
        } else {
            $index = count($this->minStack) - 1;
            if ($this->minStack[$index] > $x) {
                array_push($this->minStack, $x);
            } else {
                array_push($this->minStack, $this->minStack[$index]);
            }
        }

    }

    /**
     * @return NULL
     */
    function pop() {
        array_pop($this->stack);
        array_pop($this->minStack);
    }

    /**
     * 返回栈顶元素
     * @return Integer
     */
    function top() {
        $index = count($this->stack) - 1;
        if ($index < 0) {
            return null;
        } else {
            return $this->stack[$index];
        }
    }

    /**
     * @return Integer
     */
    function min() {
        $index = count($this->minStack) - 1;
        if ($index < 0) {
            return null;
        } else {
            return $this->minStack[$index];
        }
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->min();
 *
 * MinStack minStack = new MinStack();
minStack.push(-2);    -2,0
minStack.push(0);
minStack.push(-3);
minStack.min();   --> 返回 -3.
minStack.pop();
minStack.top();      --> 返回 0.
minStack.min();   --> 返回 -2.

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/bao-han-minhan-shu-de-zhan-lcof
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 */