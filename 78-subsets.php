<?php
// 子集
function subsets($nums) {
    $numsLen=sizeof($nums);
    if($numsLen==0)//递归终止
        return [[]];

    $ret=[];
    foreach($nums as $k=>$v){
        unset($nums[$k]);
        $res=$this->subsets($nums);//递归
        foreach($res as $vv){//处理返回结果
            array_unshift($vv,$v);
            $ret[]=$vv;
        }
    }
    $ret[]=[]; //末尾加个[]
    return $ret;//返回结果
}