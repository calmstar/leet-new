<?php

/**
 * @param String $s
 * @return Boolean
 */
function isValid($s)
{
    if (strlen($s) == 0) return true;
    $stack = [];
    $len = strlen($s);
    $map = [
        '}' => '{',
        ']' => '[',
        ')' => '(',
    ];

    for ($i = 0; $i < $len; $i++) {
        if (in_array($s[$i], ['(', '[', '{'] )) {
            array_push($stack, $s[$i]);
        } else {
            // 进行匹配
            $val = array_pop($stack);
            if ($val != $map[$s[$i]]) {
                return false;
            }
        }
    }

    if (count($stack) == 0) {
        return true;
    } else {
        return false;
    }
}
