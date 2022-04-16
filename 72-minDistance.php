<?php
class Solution {

    /**
     * https://mp.weixin.qq.com/s/uWzSvWWI-bWAV3UANBtyOw
     * 函数定义：
     *      函数dp(s1, s2, i, j) 定义为 s1[0..i]和s2[0..j] 的最小编辑距离
     * baseCase
     *      i == -1 时，return j+1
     *      j == -1 时，return i+1
     *      即a字符串走完了，剩下的操作步数就是把b字符全部删除
     * 状态转移方程
     *      if (s1[i] == s2[j]) {
                res = dp(s1, s2, i-1, j-1) // 相等
     *      } else {
                res = min(
     *              dp(s1, s2, i, j-1) + 1, // s1添加字符
     *              dp(s1, s2, i-1, j) + 1, // s1删除字符
     *              dp(s1, s2, i-1, j-1) + 1 , // s1替换字符
     *          )
     *      }
     *
     * @param String $word1
     * @param String $word2
     * @return Integer
     */
    function minDistance($word1, $word2)
    {
        return $this->dp($word1, strlen($word1)-1, strlen($word2)-1, $word2);
    }

    // ------- 备忘录 自顶向下----------
    private $memo = [];
    /**
     * @param $word1 string 目标单词
     * @param $i int 目标单词索引
     * @param $j int 原有单词索引
     * @param $word2 string 原有单词
     * @return int|mixed
     */
    function dp ($word1, $i, $j, $word2)
    {
        if (isset($this->memo[$i][$j])) {
            return $this->memo[$i][$j];
        }
        // baseCase，任意一个单词走完了，剩下的要么进行 全部删除 或 全部添加
        if ($i == -1) return $j+1;
        if ($j == -1) return $i+1;

        if ($word1[$i] == $word2[$j]) {
            // 相等情况，都跳过
            $this->memo[$i][$j] = $this->dp($word1, $i-1, $j-1, $word2);
            return $this->memo[$i][$j];
        } else {
            $this->memo[$i][$j] =  min(
                $this->dp($word1, $i, $j-1, $word2)+1, //插入
                $this->dp($word1, $i-1, $j, $word2)+1, //删除
                $this->dp($word1, $i-1, $j-1, $word2)+1 //替换
            );
            return $this->memo[$i][$j];
        }
    }

    // ------- dp table 自底向上 --------
    // https://mp.weixin.qq.com/s/uWzSvWWI-bWAV3UANBtyOw 有张图片解释，使用了空字符当作哨兵节点，方便判断
    // 类似 SwordFinger/47-礼物的最大价值.php ，抽象成二维平面，从左上角处 到 右下角处的路径最小走法
    function minDistanceV2 ($word1, $word2)
    {
        $w1 = strlen($word1); // 横向
        $w2 = strlen($word2); // 纵向
        if (empty($w2) && empty($w1)) return 0;
        if (empty($w2) || empty($w1)) return 1;

        $dp = []; // 二维，看图得知性质，也可以拍扁成一维
        // 序列化第一行: 公众号图片中，从空字符变为$word1单词需要的步骤
        for ($i = 0; $i <= $w1; $i++) { // 增加了空字符，所以是共有 $w1+1 个字符
            $dp[0][$i] = $i;
        }
        // 序列化第一列: 公众号图片中，从空字符变为$word2单词需要的步骤
        for ($j = 0; $j <= $w2; $j++) {
            $dp[$j][0] = $j;
        }
        for ($i = 1; $i <= $w1; $i++) {
            for ($j = 1; $j <= $w2; $j++) {
                if ($word1[$i-1] == $word2[$j-1]) { // 索引被我们增加了空字符，所以要-1
                    $dp[$i][$j] = $dp[$i-1][$j-1]; // 相等，相当于不用操作 -- 对脚
                } else {
                    $dp[$i][$j] = min (
                        $dp[$i-1][$j] + 1, // 增加
                        $dp[$i][$j-1] +1 , // 删除
                     $dp[$i-1][$j-1] + 1 // 替换
                    );
                }
            }
        }
        return $dp[$w1][$w2];
    }

    // 重新练习
    /**
     * 定义：
     *      dp[i][j] 代表 s1[0..i-1]和s2[0..j-1] 的最小编辑距离.
     *      ( 类似哨兵节点，往前偏移一位； i-1是s1的索引长度，j-1是s2的索引长度； i=strlen(s1) j=strlen(s2) )
     * baseCase
     *      dp[0][j]=0   代表 s1为空的时候， 编辑距离就是s2的长度
     *      dp[i][0]=0  代表 s2为空的时候， 编辑距离就是s1的长度
     * 状态转移方程
     *      if (s1[i-1] == s2[j-1]) {
                dp[i][j] = dp[i-1][j-1] // 相等, 直接等于上一次的编辑长度
     *      } else {
                dp[i][j] = min(
     *                      dp[i][j-1] + 1, // s1新增字符
     *                      dp[i-1][j] + 1, // s1删除字符
     *                      dp[i-1][j-1] + 1, // s1替换字符
     *                     )
     *      }
     *
     * @param $word1
     * @param $word2
     * @return int|void
     */
    function xx ($word1, $word2)
    {
        if (empty($word2)) return strlen($word1);
        if (empty($word1)) return strlen($word2);
        $dp = [];
        $l1 = strlen($word1);
        $l2 = strlen($word2);
        for ($i = 0; $i <= $l1; $i++) {
            $dp[$i][0] = $i;
        }
        for ($j = 0; $j <= $l2; $j++) {
            $dp[0][$j] = $j;
        }
        for ($i = 1; $i <= $l1; $i++) {
            for ($j = 1; $j <= $l2; $j++) {
                if ( $word1[$i-1] == $word2[$j-1] ) {
                    $dp[$i][$j] = $dp[$i-1][$j-1];
                } else {
                    $dp[$i][$j] = min(
                        $dp[$i-1][$j] + 1, // s1删除
                        $dp[$i][$j-1] + 1,  // s1新增
                        $dp[$i-1][$j-1] + 1// s1替换
                    );
                }
            }
        }

        return $dp[$l1][$l2];
    }

}


$a = "zoologicoarchaeologist";
$b = "zoogeologist";
$res = (new Solution())->minDistanceV2($a, $b);
var_dump($res);