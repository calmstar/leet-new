<?php
class Solution {

    private $res = []; // 总结果

    /**
     * 0 到 n-1 节点的路径
     * @param Integer[][] $graph
     * @return Integer[][]
     */
    function allPathsSourceTarget($graph)
    {
        if (empty($graph)) return [];
        $this->getPath($graph, 0, []);
        return $this->res;
    }

    function getPath ($graph, $num, $tmp)
    {
        array_push($tmp, $num);

        //到达目标
        $n = count($graph);
        if ($num == $n-1) {
            $this->res[] = $tmp;
            array_pop($tmp);
            return;
        }
        // 继续遍历 无权有向图
        foreach ($graph[$num] as $v) {
            $this->getPath($graph, $v, $tmp);
        }
        array_pop($tmp);
    }

}