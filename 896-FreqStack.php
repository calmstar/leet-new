<?php


/**
 * 最大频率栈
 * https://mp.weixin.qq.com/s/FM7pi3VH4jVlb_BNcGR8ow
 *
class FreqStack {
    // 在栈中加入一个元素 val
    public void push(int val) {}

    // 从栈中删除并返回出现频率最高的元素
    // 如果频率最高的元素不止一个，
    // 则返回最近添加的那个元素
    public int pop() {}
}
 *
 * [ val => freq ]
 * [ freq => [val1, val2] ]
 * maxFreq
 *
 * Class FreqStack
 */
class FreqStack {

    private $maxFreq; // 最高的频率值
    private $vfHash; // val-freq hash表: $vfHash[$val] = freq
    private $fvHashList; // freq-[val1,] hash表： $fvHashList[freq] = [val1, val2...]

    function __construct() {
        $this->maxFreq = 0;
        $this->vfHash = [];
        $this->fvHashList = [];
    }

    /**
     * @param Integer $val
     * @return NULL
     */
    function push($val) {
        // 维护vf表
        if (isset($this->vfHash[$val])) {
            $freq = $this->vfHash[$val] + 1;
        } else {
            $freq = 1;
        }
        $this->vfHash[$val] = $freq;
        // 维护fv表
        if (!isset($this->fvHashList[$freq])) {
            $this->fvHashList[$freq] = [];
        }
        array_push($this->fvHashList[$freq], $val);
        $this->maxFreq = max($this->maxFreq, $freq);
    }

    /**
     * @return Integer
     */
    function pop() {
        $resVal = array_pop($this->fvHashList[$this->maxFreq]);
        // 维护vf表
        $this->vfHash[$resVal]--;
        // 维护fv表
        if (empty($this->fvHashList[$this->maxFreq])) {
            $this->maxFreq--;
        }
        return $resVal;
    }
}

/**
 * Your FreqStack object will be instantiated and called as such:
 * $obj = FreqStack();
 * $obj->push($val);
 * $ret_2 = $obj->pop();
 */