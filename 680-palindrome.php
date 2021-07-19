<?php


//function solve ($s)
//{
//    $len = strlen($s);
//    if (!$len) return $s;
//    $left = 0;
//    $right = $len-1;
//    $isDel = false;
//    while ($left <= $right) {
//        if ($s[$left] == $s[$right]) {
//            $left++;
//            $right--;
//            continue;
//        }
//        // 不相等，尝试删除一个单词
//        if (!$isDel) {
//            $isDel = true;
//            // 删除左侧单词
//            if ($s[$left+1] == $s[$right]) {
//                $left = $left+2;
//                $right--;
//                continue;
//            }
//            // 删除右侧单词
//            if ($s[$left] == $s[$right-1]) {
//                $left++;
//                $right = $right - 2;
//                continue;
//            }
//            return false;
//        } else {
//            return false;
//        }
//    }
//    return true;
//}
//$aa = "cuucu"; // 会导致有问题，上面的代码只走了 1去掉c的情况，也就是 uucu 的情况，第2种情况 cuuc 会被忽略掉，所以应该两种情况都走。
//$aa = "abbca";
//$res = solve($aa);
//var_dump($res);


// 改良后的代码如下

function xxx ($s)
{
    $len = strlen($s);
    if ($len <= 2) return true;
    $left = 0;
    $right = $len - 1;
    while ($left <= $right) {
        if ($s[$left] === $s[$right]) {
            $left++;
            $right--;
            continue;
        }
        // 删除一个数字，看剩余的是否是回文数
        return isPalindrome($s, $left+1, $right) || isPalindrome($s, $left, $right-1);
    }
    return true;

}

function isPalindrome ($s, $left, $right)
{
    while ($left <= $right) {
        if ($s[$left] === $s[$right]) {
            $left++;
            $right--;
            continue;
        }
        return false;
    }
    return true;
}
