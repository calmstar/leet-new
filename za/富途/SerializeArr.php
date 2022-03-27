<?php

class Solution
{
    /**
     * 序列化数组
     */


    private $res = '';
    function solve ($array) {
        if (empty($array)) return '';
        $this->backtrack($array, []);
        return md5(ltrim($this->res, ';'));
    }
    function backtrack ($array, $path) {
        if (is_array($array)) {
            ksort($array);
        } else {
            // 字符
            $this->res .= ';' . implode(',', $path) . '=' . $array;
            retrun;
        }
        foreach ($array as $k => $v) {
            array_push($path, strtolower($k));
            $this->backtrack($v, $path);
            array_pop($path);
        }
    }
}

