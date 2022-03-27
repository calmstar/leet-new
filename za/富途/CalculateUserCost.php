<?php
class Test2 {

    /**
     * https://mubu.com/app/edit/home/kdhTm4qmM7#m
     * 计算用户的手续费
     * @param $nums
     * @return float|int
     */

    public function calculateUserCost ($nums)
    {
        if (empty($nums)) return 0;
        $configArr = $this->getConfigArr();
        $res = 0;
        foreach ($configArr as $v) {
            if ( ($v['l'] <= $nums && $nums <= $v['r']) || $v['r'] == -1 ) {
                // 在这个区间
                $newNums = $nums - $v['l'] + 1;
                $res += $newNums * $v['cost'];
                break;
            } else {
                // 不在这个区间
                $res += $v['r'] * $v['cost'];
            }
        }
        return $res;
    }
    public function getConfigArr ()
    {
        return [
            ['l' => 1, 'r' => 5, 'cost' => 30],
            ['l' => 6, 'r' => 20, 'cost' => 15],
            ['l' => 21, 'r' => -1,  'cost' => 10],
        ];
    }
}
$res = (new Test2())->calculateUserCost(6);
var_dump($res);
