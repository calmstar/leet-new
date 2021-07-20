<?php
class Solution {

    /**
     * bfs广度优先搜索，抽象成图的距离问题
     * @param String[] $deadends
     * @param String $target
     * @return Integer
     */
    function openLock($deadends, $target) {
        // $deadends 转成hash，方便 O（1） 下判断
        $deadHash = [];
        foreach ($deadends as $v) {
            $deadHash[$v] = 1;
        }

        // bfs核心结构，存储待访问的队列，再利用 $visited 减掉已经访问的元素
        $queue = [];
        array_push($queue, '0000');
        $visited = []; // 记录已访问的元素，防止因为可双向的问题形成闭环，变成死循环
        $visited['0000'] = 1;
        $num = 0;
        while (!empty($queue)) {
            $size = count($queue);
            for ($i = 0; $i < $size; $i++) {
                $curr = array_shift($queue); // 将一层的元素都弹出来,因为一层代表一次操作
                if (isset($deadHash[$curr])) continue; // 此路不通
                if ($curr == $target) return $num;

                // 穷举所有可能按步骤生成密码锁，放入queue中
                // 对锁的四个位置进行上下波动
                for  ($j = 0; $j < 4; $j++) {
                    $res1 = $this->up($curr, $j);
                    $res2 = $this->down($curr, $j);
                    if (!$visited[$res1]) {
                        array_push($queue, $res1);
                        $visited[$res1] = 1;
                    }
                    if (!$visited[$res2]) {
                        array_push($queue, $res2);
                        $visited[$res2] = 1;
                    }
                }
            }
            $num++;
        }
        return -1;
    }

    function up ($curr, $j)
    {
        if ($curr[$j] == 9) {
            $curr[$j] = 0;
        }else {
            $curr[$j] =  $curr[$j] + 1;
        }
        return $curr;
    }

    function down ($curr, $j)
    {
        if ($curr[$j] == 0) {
            $curr[$j] = 9;
        }else {
            $curr[$j] = $curr[$j] - 1;
        }
        return $curr;
    }

}

$deadends = ["0201","0101","0102","1212","2002"];
$target = "0202";
$res = (new Solution())->openLock($deadends, $target);
var_dump($res);
