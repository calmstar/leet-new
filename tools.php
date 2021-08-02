<?php

class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($val = 0, $left = null, $right = null) {
         $this->val = $val;
         $this->left = $left;
         $this->right = $right;
     }
 }

// 递归调试代码
function debug ($deep, $str = '')
{
    $space = '--';
    for ($i = 0; $i < $deep; $i++) {
        $space = $space . '--';
    }
    echo $space . ': '. $str . PHP_EOL;
}


// 第 230
/**
 * 输入一个数组，按照bfs的顺序，还原成一棵二叉树
 * @param $arr
 * @return TreeNode|null
 */
function buildTree ($arr)
{
    if (empty($arr)) return null;

    $root = new TreeNode($arr[0]);
    $newNode = [$root];
    $curr = $root;
    $change = 0;
    for ($i = 1; $i < count($arr); $i++) {  // [3,1,4,null,2]
        if ($change % 2 == 0 ) {
            $curr = array_shift($newNode);
        }
        $change++;
        if ($i % 2 == 1) {
            $node = buildChild($curr, $arr[$i], 'left');
        } else {
            $node = buildChild($curr, $arr[$i], 'right');
        }
        array_push($newNode, $node);
    }
    return $root;
}
function buildChild ($root, $val, $direction)
{
    if ($val === null) {
        $node = null;
    } else {
        $node = new TreeNode($val);
    }
    if ($direction == 'left') {
        $root->left = $node;
    } else {
        $root->right = $node;
    }
    return $node;
}