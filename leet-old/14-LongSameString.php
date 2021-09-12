<?php
/**
编写一个函数来查找字符串数组中的最长公共前缀。

如果不存在公共前缀，返回空字符串 ""。

示例 1:

输入: ["flower","flow","flight"]
输出: "fl"
示例 2:

输入: ["dog","racecar","car"]
输出: ""
解释: 输入不存在公共前缀。
说明:

所有输入只包含小写字母 a-z 。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/longest-common-prefix
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

*/
class Solution {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) 
    {
    	if (empty($strs)) return "";

        $length = strlen($strs[0]);
        $res = "";

        for ($i = 0; $i < $length; $i++) {
        	$temp = $strs[0][$i]; // 数组的第一个字符串作为模板比较
        	$flag = true; // 数组的第一个字符串的第i个字符，是否等于其他字符串的第i个字符的 标识

			try  {
				foreach ($strs as $k => $str) {
	        		if ($k == 0) {
	        			continue;
	        		}

	        		if ($str[$i] == $temp) { // 这里 $str[$i] 可能会发生指针越界的情况
	        			continue;
	        		} else {
	        			$flag = false; //有一个字符串的字符不相等，就退出循环
	        			break;
	        		}
	        	}
			} catch (\Exception $e) {
				$flag = false;
			}
        	

        	if ($flag) {
        		$res .= $temp;
        		contiue;
        	} else {
        		break;
        	}
        }
        return $res;
    }
}