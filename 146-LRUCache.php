<?php

/**
 * https://mp.weixin.qq.com/s/b0YVCccJ8mFP6lI-1NiQOQ
 *
 * LRU：least recently used 最近最少使用
 *
 * 运用你所掌握的数据结构，设计和实现一个  LRU (最近最少使用) 缓存机制 。
实现 LRUCache 类：

LRUCache(int capacity) 以正整数作为容量 capacity 初始化 LRU 缓存
int get(int key) 如果关键字 key 存在于缓存中，则返回关键字的值，否则返回 -1 。
void put(int key, int value) 如果关键字已经存在，则变更其数据值；如果关键字不存在，则插入该组「关键字-值」。
 * 当缓存容量达到上限时，它应该在写入新数据之前删除最久未使用的数据值，从而为新的数据值留出空间。
 
进阶：你是否可以在 O(1) 时间复杂度内完成这两种操作？

 * Class LRUCache
 */

class LRUCache {

    public $cache;
    public $capacity;
    public $priority;

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->cache = []; // 按关联数组使用（map）：cache[key]=val
        $this->priority = []; // 按队列使用，array_pop得到的是最近最少使用的key
        $this->capacity = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key)
    {
        if (isset($this->cache[$key])) {
            // 提升key的优先级到前面的位置
            $this->adjustPriority($key);
            return $this->cache[$key];
        }
        return -1;
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put ($key, $value)
    {
        $cou = count($this->cache);
        if (!isset($this->cache[$key]) && $cou >= $this->capacity) {
            // 添加时的容量判断：淘汰最不常使用的1个
            $unUsedKey = array_pop($this->priority);
            unset($this->cache[$unUsedKey]);
        }
        // 调整key的优先级
        $this->adjustPriority($key);
        $this->cache[$key] = $value;
    }

    private function adjustPriority ($key)
    {
        // key优先级调整
        $index = array_search($key, $this->priority);
        if ($index !== false) {
            unset($this->priority[$index]);
        }
        array_unshift($this->priority, $key);
    }

}
$res = [];
$l = new LRUCache(2);
$res[] = $l->put(1,1);
$res[] = $l->put(2,2);
$res[] = $l->get(1);
$res[] = $l->put(3,3);
$res[] = $l->get(2);
//var_dump($l->priority, $l->cache, $res);exit;
$res[] = $l->put(4,4);
$res[] = $l->get(1);
$res[] = $l->get(3);
$res[] = $l->get(4);

/**
 * 示例：
输入
["LRUCache", "put", "put", "get", "put", "get", "put", "get", "get", "get"]
[[2], [1, 1], [2, 2], [1], [3, 3], [2], [4, 4], [1], [3], [4]]
输出
[null, null, null, 1, null, -1, null, -1, 3, 4]

解释
LRUCache lRUCache = new LRUCache(2);
lRUCache.put(1, 1); // 缓存是 {1=1}
lRUCache.put(2, 2); // 缓存是 {1=1, 2=2}
lRUCache.get(1);    // 返回 1
lRUCache.put(3, 3); // 该操作会使得关键字 2 作废，缓存是 {1=1, 3=3}
lRUCache.get(2);    // 返回 -1 (未找到)
lRUCache.put(4, 4); // 该操作会使得关键字 1 作废，缓存是 {4=4, 3=3}
lRUCache.get(1);    // 返回 -1 (未找到)
lRUCache.get(3);    // 返回 3
lRUCache.get(4);    // 返回 4

 */