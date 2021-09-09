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
        $this->priority = []; // 按队列使用，array_pop得到的是最少使用的key。unset时需要先找到此key对应的索引，O(n)
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

    // 重新调整优先级，array_search时间复杂度为O(n)
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

// --------------------------------------------

/**
 * https://mp.weixin.qq.com/s/b0YVCccJ8mFP6lI-1NiQOQ
 *
 * Class LRUCacheV2
 */
class LRUCacheV2 {

    // Node(k1, v1) <-> Node(k2, v2)... 【双向链表，存入[key,val]】
    private $cacheDoubleList;

    // key -> Node(key, val)【只存key，用于快速定位到cache双向链表，存入[key, node] （node为链表节点）】
    private $hash;

    // $cacheDoubleLink 容量限制
    private $cap;

    public function __construct($capacity)
    {
        $this->cap = $capacity;
        $this->hash = [];
        $this->cacheDoubleList = new DoubleList();
    }

    public function put  ($key, $value)
    {
        if (!isset($this->hash[$key])) {
            // key不存在，判断容量，重置优先级，重新加入
            if ($this->cacheDoubleList->getSize() >= $this->cap) {
                // 容量不足,淘汰旧的
                $this->removeLeastRecently();
            }
            $this->addRecently($key, $value);

        } else {
            // key 存在，重置优先级，修改内容
            $this->makeRecently($key);
            $node = $this->hash[$key];
            $node->val = $value;
        }
    }

    public function get ($key)
    {
        if (!isset($this->hash[$key])) {
            return -1;
        }
        // 提升key的优先级
        $this->makeRecently($key);
        // 返回值
        $node = $this->hash[$key];
        return $node->val;
    }

    /**
     * 将某个key重置为最新
     * @param $key
     */
    private function makeRecently ($key)
    {
        $node = $this->hash[$key];
        // 先移除后添加，则最新
        $this->cacheDoubleList->remove($node);
        $this->cacheDoubleList->addLast($node);
    }

    /**
     * 添加最近使用的元素
     * @param $key
     * @param $val
     */
    private function addRecently ($key, $val)
    {
        $node = new Node($key, $val);
        // 链表尾部添加元素
        $this->cacheDoubleList->addLast($node);
        // map中加映射
        $this->hash[$key] = $node;
    }

    /**
     * 删除某一个key
     * @param $key
     */
    private function deleteKey ($key)
    {
        $node = $this->hash[$key];
        $this->cacheDoubleList->remove($node);
        unset($this->hash[$key]);
    }

    /**
     * 移除最久未使用的元素
     */
    private function removeLeastRecently ()
    {
        $node = $this->cacheDoubleList->removeFirst();
        $key = $node->key;
        unset($this->hash[$key]);
    }

}

// 节点定义
class Node {
    public $key; // 属性key
    public $val; // 属性val
    public $prev; // 指向的上一个节点地址
    public $next;  // 指向的下一个节点地址

    public function __construct($key, $val)
    {
        $this->key = $key;
        $this->val = $val;
    }
}

// 双向链表定义
class DoubleList {
    // 头尾虚节点
    public $head;
    public $tail;
    // 链表大小
    public $size;

    public function __construct()
    {
        $this->head = new Node(0, 0);
        $this->tail = new Node(0, 0);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
        $this->size = 0;
    }

    // 在尾部添加节点
    public function addLast (Node $node)
    {
        // 新节点连接链表节点
        $node->next = $this->tail;
        $node->prev = $this->tail->prev;
        // 链表节点连接新节点
        $this->tail->prev->next = $node;
        $this->tail->prev = $node;
        $this->size++;
    }

    // 移除头部节点 --- 移除最久未使用的节点
    public function removeFirst ()
    {
        $first = $this->head->next;
        if ($first == $this->tail) return; // 没有节点可删除
        $this->remove($first);
        return $first;
    }

    public function remove (Node $node)
    {
        // 断掉其他节点和node的连接
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
        // 断掉node和其他节点的连接
        $node->prev = null;
        $node->next = null;
        $this->size--;
    }

    // 返回链表大小
    public function getSize ()
    {
        return $this->size;
    }
}

