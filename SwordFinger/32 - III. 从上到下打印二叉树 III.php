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
class Solution {

    function levelOrderV2($root)
    {
        if (empty($root)) return [];
        $queue = [];
        array_push($queue, $root);
        $deep = 1; // 第一层深度从左往右，第二层深度从右往左，奇数左右，偶数右左
        $res = [];
        while (!empty($queue)) {
            $cou = count($queue);
            $tmpRes = [];

            // 放节点到队列
            for ($i = 0; $i < $cou; $i++) {
                $node = array_shift($queue);

                // 双端队列解法 -- 取出放到临时节点
                if ($deep % 2 == 1) {
                    // 奇数 从左往右
                    array_push($tmpRes, $node->val);
                } else {
                    // 偶数 从右往左 -- unshift
                    array_unshift($tmpRes, $node->val);
                }

                // 放入节点的顺序一定是从左往右
                if ($node->left) {
                    array_push($queue, $node->left);
                }
                if ($node->right) {
                    array_push($queue, $node->right);
                }
            }

            $res[] = $tmpRes;
            $deep++;
        }
        return $res;
    }

    /**
     * https://leetcode-cn.com/problems/cong-shang-dao-xia-da-yin-er-cha-shu-iii-lcof/submissions/
     * 解法1
     * @param $root
     * @return array
     */
    function levelOrder($root)
    {
        if (empty($root)) return [];
        $queue = [];
        array_push($queue, $root);
        $deep = 1; // 第一层深度从左往右，第二层深度从右往左，奇数左右，偶数右左
        $res = [];
        while (!empty($queue)) {
            $cou = count($queue);
            $tmpRes = [];
            // 放节点的顺序，一定是从左往右放，遍历的顺序就根据奇偶来变化: 从前往后 从后往前
            // 获取节点，不取出，只访问
            if ($deep % 2 == 0) {
                for ($i = $cou-1; $i >= 0; $i--) {
                    $tmpRes[] = $queue[$i]->val;
                }
            } else {
                for ($i = 0; $i < $cou; $i++) {
                    $tmpRes[] = $queue[$i]->val;
                }
            }

            // 放节点到队列
            for ($i = 0; $i < $cou; $i++) {
                $node = array_shift($queue);
                if ($node->left) {
                    array_push($queue, $node->left);
                }
                if ($node->right) {
                    array_push($queue, $node->right);
                }
            }

            $res[] = $tmpRes;
            $deep++;
        }
        return $res;
    }
    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrderMy($root)
    {
        if (empty($root)) return [];
        $queue = [];
        array_push($queue, $root);
        $deep = 1; // 第一层深度从左往右，第二层深度从右往左，奇数左右，偶数右左
        $res = [];
        while (!empty($queue)) {
            $cou = count($queue);
            $tmpRes = [];
            for ($i = 0; $i < $cou; $i++) {
                $node = array_shift($queue);
                $tmpRes[] = $node->val;
                // 奇数层的时候安排好下一次偶数层的深度 -- 不能完全调换顺序 -- 不符合题意
                if ($deep % 2 == 1) {
                    if ($node->right) {
                        array_push($queue, $node->right);
                    }
                    if ($node->left) {
                        array_push($queue, $node->left);
                    }
                } else {
                    // 偶数
                    if ($node->left) {
                        array_push($queue, $node->left);
                    }
                    if ($node->right) {
                        array_push($queue, $node->right);
                    }
                }
            }
            $res[] = $tmpRes;
            $deep++;
        }
        return $res;
    }
}