<?php
class Solution {

    /**
     * 请实现一个函数，把字符串 s 中的每个空格替换成"%20"。

    输入：s = "We are happy."
    输出："We%20are%20happy."
     * @param $s
     * @return string
     */
    function replaceSpace($s)
    {
        $arr = explode(' ', $s);
        return implode('%20', $arr);
    }

    /**
     * @param String $s
     * @return String
     */
    function replaceSpaceMy($s)
    {
        $len = strlen($s);
        $needReplace = [];
        for ($i = 0; $i < $len; $i++) {
            if ($s[$i] === ' ') {
                $needReplace[] = $i;
            }
        }
        foreach ($needReplace as $v) {
            $s[$v] = '20%'; // 此处只能存放一个字符 -- 改变策略
        }
        return $s;
    }
}
$s = "We are happy.2";
$res = (new Solution())->replaceSpace($s);
var_dump($res);