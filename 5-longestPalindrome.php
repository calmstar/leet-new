<?php

// 最长回文子串
/**
 * 输入：s = "babad"
输出："bab"
解释："aba" 同样是符合题意的答案。
 */

/**
 *  暴力法
 * 1 找到所有字串 O(n2)
 * 2 判断字串是否为回文串 O(n)
 * 总 O（n3）
 *

 * @param $s
 * @return mixed
 */
function longestPalindrome($s)
{
    $max = $s[0];
    $len = strlen($s);
    for ($i = 0; $i < $len; $i++) {
        $str = '';
        for ($j = $i; $j < $len; $j++) {
            $str .= $s[$j];
            $res = isPalindrome($str);
            if ($res && strlen($str) > strlen($max)) {
                $max = $str;
            }
        }
    }
    return $max;
}

// 分治法+递归法
function longestPalindrome2($s)
{
    $len = strlen($s);
    if ($len < 2) return $s;
    $l = 0;
    $r = $len - 1;
    $midL = $l;
    $midR = $r;
    while ($midL <= $midR) {
        if ($s[$midL] != $s[$midR]) {
            // 有一个不等，进入下一个递归
            $mid = $l + intval(($r-$l)/2);
            $sL = longestPalindrome2(substr($s, $l, $mid + 1 - $l));
            $sR = longestPalindrome2(substr($s, $mid, $r+1-$mid));
            return strlen($sL) > strlen($sR) ? $sL : $sR;
        }
        $midL++;
        $midR--;
    }
    return $s;
}


function isPalindrome ($str)
{
    $len = strlen($str);
    $minIndex = intval($len / 2);
    for ($i = 0; $i < $minIndex; $i++) {
        if ($str[$i] !== $str[$len-1-$i]) {
            return false;
        }
    }
    return true;
}

//$s = 'babad';
//$res = longestPalindrome2($s);
//var_dump($res);

//-------------------

// 中心扩展法 -- labuladong
function xx ($str)
{
    $len = strlen($str);
    if ($len < 2) return $len;
    // 以每个字母（$str[$i]）为中心向两边扩展，和 $str[$i]   $str[$i+1] 为中心向两边扩展
    $maxStr = '';
    for ($i = 0; $i < $len; $i++) {
        $res = findPalindrome($i, $i, $str); // 以当前点为中心进行扩展
        $res2 = findPalindrome($i, $i+1, $str); // 以当前点和下一点为中心进行扩展
        // 得到最长的回文子串
        $maxStr = strlen($maxStr) > strlen($res) ? $maxStr : $res;
        $maxStr = strlen($maxStr) > strlen($res2) ? $maxStr : $res2;
    }
    return $maxStr;
}

function findPalindrome ($l, $r, $str)
{
    $len = strlen($str);
    while ($l <= $r && $l >= 0 && $r < $len && $str[$l] == $str[$r]) {
        $l--;
        $r++;
    }
    return substr($str, $l+1, $r-$l-1); // 需要用实际例子进行推算offset和length
}

$sss = 'babad';
$res = xx($sss);
var_dump($res);