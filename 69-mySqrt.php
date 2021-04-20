<?php
function mySqrt($x)
{
    return floor(sqrt($x));
}

function mySqrt1($x)
{
    if($x==0) return 0;
    $left = 1;
    $right = floor($x/2);
    while($left < $right){
        $mid = $right - floor(($right - $left)/2);
        if($mid*$mid>$x){
            $right = $mid-1;
        }else{
            $left = $mid;
        }
    }
    return $left;
}

