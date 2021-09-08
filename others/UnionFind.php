<?php
/**
 * https://mp.weixin.qq.com/s/gUwLfi25TYamq8AJVIopfA
 *
 * 现在我们的 Union-Find 算法主要需要实现这两个 API：
class UF {
// 将 p 和 q 连接
public void union(int p, int q);
    // 判断 p 和 q 是否连通
    public boolean connected(int p, int q);
    // 返回图中有多少个连通分量
    public int count();
}
 */

class UF {

    // 连通分量个数
    private  $count = 0;

    // 存储整棵树。找到x的父节点:$parent[$x]
    private $parent = [];

    // 存储以x为$root节点的树的节点数量
    private $size = [];

    public function __construct($n)
    {
        // 初始化
        $this->count = $n;
        for ($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i; // 初始就是root节点，自己指向自己
            $this->size[$i] = 1;
        }
    }

    // 将节点进行连接
    public function union ($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        if ($rootP == $rootQ) {
            // 本来就连通，不用操作
            return;
        }
        // 进行连通: 节点少的树，依附在节点多的树上的根节点.较平衡
        if ($this->size[$rootP] > $this->size[$rootQ]) {
            $this->parent[$rootQ] = $rootP;
            $this->size[$rootP] += $this->size[$rootQ];
        } else {
            $this->parent[$rootP] = $rootQ;
            $this->size[$rootQ] += $this->size[$rootP];
        }
        // 减少连通量
        $this->count--;
    }

    // 判断节点是否连通
    public function connected ($p, $q)
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);
        // 连通的说明共有一个root节点
        return $rootP == $rootQ;
    }

    // 找到 $x 的跟节点
    public function find ($x)
    {
        // 根节点的父节点指向自己
        while ($x != $this->parent[$x]) {
            // 进行路径压缩，防止n叉树过高: -- 优化成常量
            // 当前节点直接指向爷爷节点，而不是父亲节点；这样当前节点和父亲节点就一起指向了爷爷节点，降低树高度
            $this->parent[$x] = $this->parent[$this->parent[$x]];
            $x = $this->parent[$x];
        }
        return $x;
    }

}