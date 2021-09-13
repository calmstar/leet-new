<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

// 给你一个整数 n ，请你生成并返回所有由 n 个节点组成且节点值从 1 到 n 互不相同的不同 二叉搜索树 。可以按 任意顺序 返回答案。
// 95. 不同的二叉搜索树 II
/**
 * 输入：n = 3
输出：[[1,null,2,null,3],[1,null,3,2],[2,1,3],[3,1,null,null,2],[3,2,null,1]]

 */
class Solution {

    /**
     * 题解clone
     * @param Integer $n
     * @return TreeNode[]
     */
    function generateTrees($n) {
        if($n==0)
            return [];

        return $this->create(1,$n);
    }

    function create($l,$r){
        $allTree=[];
        if($l>$r){
            $allTree[]=null;
            return $allTree;
        }

        for($i=$l;$i<=$r;$i++){
            $left=$this->create($l,$i-1);
            $right=$this->create($i+1,$r);

            foreach($left as $lNode){
                foreach($right as $rNode){
                    $node=new TreeNode($i);
                    $node->left=$lNode;
                    $node->right=$rNode;
                    $allTree[]=$node;
                }
            }
        }
        return $allTree;
    }
}

