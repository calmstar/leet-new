<?php

/**
 * https://mp.weixin.qq.com/s/K_oV5JWYpBo9cWTHz6e35Q
 *  被围绕的区域
 *
 *  给你一个 m x n 的矩阵 board ，由若干字符 'X' 和 'O' ，
 * 找到所有被 'X' 围绕的区域，并将这些区域里所有的 'O' 用 'X' 填充。

 * Class Solution
 */
class Solution {

    /**
     * @param String[][] $board
     * @return NULL
     */
    function solve(&$board) {
        $m=sizeof($board);
        if($m==0){
            return;
        }
        $n=sizeof($board[0]);
        for($i=0;$i<$n;$i++){//处理第一行和最后一行
            $this->dfs($board,0,$i);
            $this->dfs($board,$m-1,$i);
        }
        for($i=0;$i<$m;$i++){//处理第一列和最后一列
            $this->dfs($board,$i,0);
            $this->dfs($board,$i,$n-1);
        }
        for($i=1;$i<$m-1;$i++){
            for($j=1;$j<$n-1;$j++){
                if($board[$i][$j]=='O'){//将剩余不连通的O标记为X
                    $board[$i][$j]='X';
                }
            }
        }
        for($i=0;$i<$m;$i++){//复原那些#
            for($j=0;$j<$n;$j++){
                if($board[$i][$j]=='#'){
                    $board[$i][$j]='O';
                }
            }
        }
    }

    function dfs(&$board,$i,$j){//将与边联通的O，全部标记为#
        $m=sizeof($board);
        $n=sizeof($board[0]);
        if($i<0||$i>=$m||$j<0||$j>=$n){
            return;
        }

        if($board[$i][$j]!='O'){
            return;
        }
        $board[$i][$j]='#';//标记

        // 向上下左右四个方向扩散
        $this->dfs($board,$i+1,$j);//递归dfs
        $this->dfs($board,$i,$j+1);//递归dfs
        $this->dfs($board,$i-1,$j);//递归dfs
        $this->dfs($board,$i,$j-1);//递归dfs
    }

    /**
     * 并查集算法
     * O中需要保留的节点 就跟dummy节点相连通。
     * 则：不跟dummy节点连通的，且为O的，则要转为X
     *
     * @param String[][] $board
     * @return NULL
     */
    function solveV2(&$board) {
        $m=sizeof($board);//行数
        if($m==0){
            return;
        }
        $n=sizeof($board[0]);//列数
        $dummy=$m*$n;//虚拟节点
        $union=new UnionFind($m*$n+1);//初始化并查集：二维变成一维的长度换算

        for($i=0;$i<$n;$i++){//处理第一行和最后一行里的O
            if($board[0][$i]=='O'){
                $union->union($i,$dummy);//与虚拟节点union连通
            }
            if($board[$m-1][$i]=='O'){
                $union->union(($m-1)*$n+$i,$dummy);//与虚拟节点union连通
            }
        }
        for($i=0;$i<$m;$i++){//处理第一列和最后一列里的O
            if($board[$i][0]=='O'){
                $union->union($i*$n,$dummy);//与虚拟节点union
            }
            if($board[$i][$n-1]=='O'){
                $union->union($i*$n+$n-1,$dummy);//与虚拟节点union
            }
        }
        $direction=[
            [1,0],[0,1],[-1,0],[0,-1]
        ];//处理四个方向的技巧数组
        for($i=1;$i<$m-1;$i++){//遍历除了4条边上，其他的所有点
            for($j=1;$j<$n-1;$j++){
                if($board[$i][$j]=='O'){
                    foreach($direction as $k=>$v){
                        $x=$i+$v[0];
                        $y=$j+$v[1];
                        if($board[$x][$y]=='O'){
                            $union->union($x*$n+$y,$i*$n+$j);//将为O的节点 与边上的节点相连
                        }
                    }
                }
            }
        }
        for($i=1;$i<$m-1;$i++){//最后将不和虚拟节点联通的O都变成X
            for($j=1;$j<$n-1;$j++){
                if(!$union->connected($dummy,$i*$n+$j)){
                    $board[$i][$j]='X';
                }
            }
        }
    }

}

//并查集数据结构
Class UnionFind{
    private $parents=[];
    private $size=[];
    private $count;
    public function __construct($n){
        $this->count=$n;
        for($i=0;$i<$n;$i++){
            $this->size[$i]=1;
            $this->parents[$i]=$i;
        }
    }

    public function union($p,$q){
        $pRoot=$this->find($p);
        $qRoot=$this->find($q);
        if($pRoot==$qRoot){
            return;
        }

        if($this->size[$pRoot]>$this->size[$qRoot]){
            $this->parents[$qRoot]=$pRoot;
            $this->size[$pRoot]+=$this->size[$qRoot];
        }else{
            $this->parents[$pRoot]=$qRoot;
            $this->size[$qRoot]+=$this->size[$pRoot];
        }
        $this->count--;
    }

    public function connected($p,$q){
        $pRoot=$this->find($p);
        $qRoot=$this->find($q);
        return $pRoot==$qRoot;
    }

    public function find($p){
        while($this->parents[$p]!=$p){
            $this->parents[$p]=$this->parents[$this->parents[$p]];
            $p=$this->parents[$p];
        }
        return $p;
    }

    public function count(){
        return $this->count;
    }
}

