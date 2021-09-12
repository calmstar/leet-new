<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2020/3/10
 * Time: 14:55
 */


/**
 *
 * 5. 最长回文子串
 *
 * 给定一个字符串 s，找到 s 中最长的回文子串。你可以假设 s 的最大长度为 1000。

示例 1：

输入: "babad"
输出: "bab"
注意: "aba" 也是一个有效答案。
示例 2：

输入: "cbbd"
输出: "bb"

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/longest-palindromic-substring
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/****************  动态规划  ****************/

/**
 * 资料查看：https://www.bilibili.com/video/av63084966/?spm_id_from=333.788.videocard.0
 * @param $s
 * @return mixed
 */
function longestPalindromeMy ($s)
{
    $len = strlen($s);
    if ($len < 2) return $s;
    $begin = 0;
    $maxLen = 1;
    $dp = [];

    // 赋初始值
    for ($c = 0; $c < $len; $c++) {
        for ($v = 0; $v < $len; $v++) {
            if ($c == $v) {
                $dp[$c][$v] = 1;
            } else {
                $dp[$c][$v] = 0;
            }
        }
    }

    // 逻辑
    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $i; $j++) {
            // $i-$j == 1 代表两元素相邻; $dp[$j+1][$i-1] 代表其中间的字串也是回文串
            if ($s[$i] == $s[$j] && ($i-$j == 1 || $dp[$j+1][$i-1])) {
                $dp[$j][$i] = 1;
            }
            if ($dp[$j][$i] && $i-$j+1 > $maxLen) {
                $maxLen = $i-$j+1;
                $begin = $j;
            }
        }
    }
    return substr($s, $begin, $maxLen);
}


/**
 * @param String $s
 * @return String
 */
function longestPalindrome($s) {
    $len = strlen($s);
    if($len < 2) return $s;         //初始化判断
    $dp = [];                       //初始化动态规划dp数组，dp[i][j]表示从j到i的字符串是否为回文串
    $right = $left = 0;             //初始化最长的最优节点
    for($i=0;$i<$len;++$i){
        $dp[$i][$i] = true;         //只有一个元素的时候肯定为true
        for($j=$i-1;$j>=0;--$j){    //遍历到第i个元素，再倒退判断是否为回文串
            //头i尾j两个元素相等，且dp[i-1][j+1]是回文串，即dp[i][j]也是回文串
            //特殊情况,“bb”,此时dp[i-1][j+1]=dp[j][i]此时数组不成立，不存在截取的反向字符串
            $dp[$i][$j] = $s[$i] == $s[$j] && ($i-$j==1 || $dp[$i-1][$j+1]);
            if($dp[$i][$j] && ($i-$j)>($right-$left)){
                $right = $i;        //截取的字符串的长度大于之前求得的左右长度，则取的左右下标点
                $left = $j;
            }
        }
    }
    return substr($s,$left,$right-$left+1); //截取字符串
}

/****************  暴力法  ****************/

/**
 * 暴力法
 * @param $s
 * @return bool|string
 */
function longestPalindromeOfficial ($s)
{
    $len = strlen($s);
    if($len < 2) return $s;         //初始化判断
    $max = $s[0];
    for($i=0;$i<$len;$i++){         //从每一个字符开始，截取到最后一个字符
        for($j=$i+1;$j<$len;++$j){
            $str = substr($s, $i,$j-$i+1);  //正向字符串
            $restr = strrev($str);          //反向字符串
            if($str == $restr && strlen($str) > strlen($max)){
                $max = $str;        //比较是否是回文串，且比当前最大的子串长
            }
        }
    }
    return $max;
}

echo " \n----- 我的-暴力法：遍历得到所有的子字符串，看看是不是回文数. 会超时 ----- \n";

class Solution {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $len = strlen($s);
        if ($len < 2) return $s;

        $strArr = [];
        for ($i = 0; $i < $len; $i++) {
            $str = ''; // 每换一个起始字符，都要清空一次str
            for ($j = $i; $j < $len; $j++) {
                $str .= $s[$j];
                $tempLen = strlen($str);
                if ($tempLen == 1) continue; // 起码两个字符才往下执行

                $res = $this->isPalindrome($str, $tempLen); // $j+1 表示当前字符串长度
                if ($res) $strArr[$tempLen] = $str;
            }
        }
        ksort($strArr);
        $resStr = array_pop($strArr);
        return $resStr ? $resStr : $s[0];
    }


    private function isPalindrome ($str, $len)
    {
        $reverStr = '';
        for ($k = $len; $k >= 0; $k--) {
            $reverStr .= $str[$k];
        }
        if ($reverStr == $str) {
            return true;
        } else {
            return false;
        }
    }

}

//$str = 'babad';
$str = 'cbbd';
$s = new Solution();
$res = $s->longestPalindrome($str);
var_dump($res);