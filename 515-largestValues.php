<?php


class Solution {

    /**
     * 二叉树：在每个树行中找最大值
     *
     * @param TreeNode $root
     * @return Integer[]
     */
    function largestValues($root)
    {
        $res = [];
        if ($root === null) return $res;
        $queue = [];
        array_push($queue, $root); // 队尾进入
        while (!empty($queue)) {
            $num = count($queue);
            $floor = [];
            while ($num > 0) {
                $tmp = array_shift($queue); // 队头出
                $floor[] = $tmp->val;

                $tmp->left && array_push($queue, $tmp->left);
                $tmp->right && array_push($queue, $tmp->right);
                $num--;
            }
            $res[] = max($floor); // 取最大值
        }
        return $res;
    }
}