<?php
require_once 'tools.php';
class Solution {
    /**
     * 平衡二叉树
     * 给定一个二叉树，判断它是否是高度平衡的二叉树。
    本题中，一棵高度平衡二叉树定义为：
    一个二叉树每个节点 的左右两个子树的高度差的绝对值不超过 1
     */
    // ----------- 递归法 -----------
    function isBalancedV2($root)
    {
        return $this->getDepth($root) == -1 ? false : true;
    }
    function getDepth ($root)
    {
        if ($root === null) return 0;
        $leftDepth = $this->getDepth($root->left);
        if ($leftDepth == -1) return -1;

        $rightDepth = $this->getDepth($root->right);
        if ($rightDepth == -1) return -1;

        return abs($leftDepth-$rightDepth) > 1 ? -1 : 1 + max($leftDepth, $rightDepth);

    }

    // -------------- 迭代法 --------------

    /**
     * 迭代法：分别计算出最小深度 和 最大深度，然后相减，看是否大于1
     *          --- 有问题，最小深度是左右子节点都要为空，而这里平衡二叉树 只要左右任意一个节点不为空，都算入不平衡的范围
     *
     * @param TreeNode $root
     * @return Boolean
     */
    function isBalanced($root)
    {
        if ($root === null) return true;
        $queue = [];
        array_push($queue, $root);
        $maxDeep = 0;
        $minDeep = 0;
        while (!empty($queue)) {
            // 得到最大深度
            $maxDeep++;
            $num = count($queue);
            while ($num > 0) {
                $tmp = array_shift($queue);

                // $minDeep 如果没被设置过了，就需要设置
                if ($minDeep == 0) {
                    // 得到最小深度
                    if (!$tmp->left && !$tmp->right) $minDeep = $maxDeep;
                }
                $tmp->left !== null && array_push($queue, $tmp->left);
                $tmp->right !== null && array_push($queue, $tmp->right);
                $num--;
            }
        }
        echo $maxDeep . ' ----- ' . $minDeep;

        if ($maxDeep == $minDeep && $maxDeep > 2) {
            // 判断是只倾向一边，还是 满二叉树
            if ( ($root->left && $root->right) || (!$root->left && !$root->right)) {
                // 两个节点有值--满二叉树 , 或只有一个root节点
                return true;
            } else {
                // 倾向一边
                return false;
            }
        } else {
            return ($maxDeep-$minDeep > 1) ? false : true;
        }
    }

}
$arr = [1,2,2,3,null,null,3,4,null,null,4];
$root = buildTree($arr);
print_r($root);

$res = (new Solution())->isBalanced($root);
var_dump($res);