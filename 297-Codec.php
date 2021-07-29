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

class Codec {

    private $data = [];

    function __construct() {

    }

    // 递归调试代码
    private $deep = 0;
    function debug ($deep, $str = '')
    {
        $space = '--';
        for ($i = 0; $i < $deep; $i++) {
            $space .= '--';
        }
        echo $space . ': '. $str . PHP_EOL;
    }

    /**
     * 前序遍历进行序列化 -- 注意把空指针信息也存入
     * @param TreeNode $root
     * @return String
     */
    function serialize($root)
    {
        $this->preOrder($root);
        $res = implode(',', $this->data);
        return $res;
    }

    function preOrder ($root)
    {
        if ($root === null) {
            array_push($this->data, null);
            return;
        }
//        $this->debug($this->deep++, $root->val);
        array_push($this->data, $root->val);
        $this->preOrder($root->left);
        $this->preOrder($root->right);
    }

    /**
     * https://mp.weixin.qq.com/s/DVX2A1ha4xSecEXLxW_UsA
     *PS：一般语境下，单单前序遍历结果是不能还原二叉树结构的，因为缺少空指针的信息，至少要得到前、中、后序遍历中的两种才能还原二叉树。但是这里的 node 列表包含空指针的信息，所以只使用 node 列表就可以还原二叉树。
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data)
    {
        $arr = explode(',', $data);
        return $this->deCode($arr);

    }

    function deCode ($arr)
    {
        if (empty($arr)) return null;
        // 将前序遍历 序列化的值，变回二叉树
        $res = array_shift($arr);
        $this->debug($this->deep++, count($arr));
        if ($res === null) return null;

        $root = new TreeNode($res);
        $root->left = $this->deCode($arr); // fail --- 由于是数组，无法很好的递归连带，一个元素会被使用很多次
        $root->right = $this->deCode($arr);
        return $root;
    }
}

/**
 * Your Codec object will be instantiated and called as such:
 * $ser = Codec();
 * $deser = Codec();
 * $data = $ser->serialize($root);
 * $ans = $deser->deserialize($data);
 *
 * 输入：root = [1,2,3,null,null,4,5]
输出：[1,2,3,null,null,4,5]

 */