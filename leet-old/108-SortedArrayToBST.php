<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/2
 * Time: 14:42
 */

/**
 * 将一个按照升序排列的有序数组，转换为一棵高度平衡二叉搜索树。

本题中，一个高度平衡二叉树是指一个二叉树每个节点 的左右两个子树的高度差的绝对值不超过 1。

示例:

给定有序数组: [-10,-3,0,5,9],

一个可能的答案是：[0,-3,9,-10,null,5]，它可以表示下面这个高度平衡二叉搜索树：

     0
    / \
  -3   9
  /    /
-10   5

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/convert-sorted-array-to-binary-search-tree
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */


class TreeNode {
     public $val = null;
     public $left = null;
     public $right = null;
     function __construct($value) { $this->val = $value; }
}

class Solution {

    public $midArr = [];

    /**
     * @param Integer[] $nums
     * @return TreeNode
     */
    function sortedArrayToBST($nums) {
        // 需要选举好根节点才可以，否则二叉搜索树插入会退化成 O(n) 或 节点深度之间相差大于1
        $this->getMidArr($nums);
        $nums = $this->midArr;
        $root = new TreeNode($nums[0]);
        $cou = count($nums);
        // 将数组后面的值依次插入 BST (二叉搜索树)
        for ($i = 1; $i < $cou; $i++) {
            $this->insertBSTTree($root, $nums[$i]);
        }
        return $root;
    }

    /**
     * 使用二分查找思想，递归得到每个中间数组的中间值，然后依次存入新数组中
     * @param $arr
     */
    public function getMidArr ($arr)
    {
        $cou = count($arr);
        if ($cou == 0) {
            return ;
        }
        if ($cou == 1) {
            $this->midArr[] = $arr[0];
            return ;
        }

        $mid = floor(count($arr)/2);
        $this->midArr[] = $arr[$mid];

        // 也可以使用改变 left 和 right 索引的方式，动态得到中间索引。
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid+1); // 注意$mid+1，才能去掉$mid本身
        $this->getMidArr($left);
        $this->getMidArr($right);
    }

    /**
     * 将新节点插入树中，并保证结果为二叉搜索树
     * @param $root
     * @param $value
     */
    private function insertBSTTree (&$root, $value)
    {
        // 将值打包成一个节点
        $node = new TreeNode($value);
        $temp = $root;
        while (!empty($temp)) {
            if ($temp->val < $value) {
                // 放在右边
                if (empty($temp->right)) {
                    $temp->right = $node;
                    break; // 放入成功就终止
                } else {
                    $temp = $temp->right;
                }
            } else {
                // 放在左边
                if (empty($temp->left)) {
                    $temp->left = $node;
                    break;// 放入成功就终止
                } else {
                    $temp = $temp->left;
                }
            }
        }
    }

    /**
     * 广度优先遍历 - 层次遍历
     * @param Node $node
     */
    function BFS (TreeNode $node)
    {
        $queue = [$node]; // 把整个节点存入，方便更新节点
        while (!empty($queue)) {
            $node = array_pop($queue); // 从队头取出元素
            echo $node->val . " "; // 4 10 3 5 1 2
            $node->left && array_unshift($queue, $node->left); // 从队尾补充元素
            $node->right && array_unshift($queue, $node->right); // 从队尾补充元素
        }
    }
}

$arr = [-10,-3,0,5,9];
$s = new Solution();
$tree = $s->sortedArrayToBST($arr);
$s->BFS($tree);


// 官方解法
class SolutionOfficial {
    private $nums;

    function sortedArrayToBST($nums)
    {
        $this->nums = $nums;
        return $this->helper(0, count($nums)-1);
    }

    private function helper ($left, $right)
    {
        // 因为要构成二叉搜索树，且子树之间的高度差不能大于1
        // 又因为数组 $nums 为有序数组，所以每次对半得到中间索引的数组元素插入树中即可
        if ($left > $right) return null;

        $mid = intval(($left + $right)/2 );

        $node = new TreeNode($this->nums[$mid]);
        $node->left = $this->helper($left, $mid-1); // 数组左边的数字本来就比中间索引的小，递归放入即可
        $node->right = $this->helper($mid+1, $right);
        return $node;
    }
}
echo "=== 我的解法 ==\n";
$arr = [-10,-3,0,5,9];
$ss = new SolutionOfficial();
$res = $ss->sortedArrayToBST($arr);
var_dump($res);
