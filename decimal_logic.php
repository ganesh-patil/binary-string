<?php
ini_set('memory_limit','1024M');
$n = 21;
$list = array(0);
$maxExponent = pow(2, $n)/2;
//var_dump($maxExponent);die;
for($i=0; $i< $n; $i++){
    $list = array_merge($list,getList(pow(2, $i)));
//    if(count($list) >= $maxExponent) {
//        break;
//    }
    if(count($list) >= $n) {
        break;
    }
//    var_dump($list);
}

$list = array_chunk($list,$n);
var_export($list[0]);
//$list = array_chunk($list,$n);
//var_export($list);

function getList($number) {
    $finalList = $lowerList = $higherList =  array();
    $lowerList = getLowerList($number, $number+$number/2);
    
    if($number > 1) {
        $higherList = getHigherList($number+$number/2, 2*$number);
        $finalList = array_merge($higherList, $lowerList);
    }
    else {
        $finalList = $lowerList;
    }
    return $finalList;
}

function getLowerList($number, $max) {
     $initialList = processChunks($number, $max);
     $initialList = array_reverse($initialList);
    return $initialList;
    //5,4
}

function getHigherList($number, $max) {
    return processChunks($number, $max);
}

function processChunks($number, $max){
    $initialList  = array();
    if(($max - $number) > 8) {  //32, 48
        $recursiveHigher = getHigherList($number, $number+(($max - $number)/2));
        $recursiveLower = getLowerList($number+(($max - $number)/2), $max);
        $initialList = array_merge($recursiveHigher, $recursiveLower);
    }
    else {
    for($i=$number; $i< $max; $i++) {
        $initialList[] = $i;
    }
    if(!empty($initialList)) {
        if(count($initialList) >= 4) {
            $initialList = reverseLastTwoDigitsOfEverySplit($initialList);
            if(count($initialList) > 4 ){
                $chunks = array_chunk($initialList, 4);
                $chunks[1] = array_reverse($chunks[1]);
                $initialList = null;
                $initialList = array_merge($chunks[0], $chunks[1]);
            }
        }
    }
    
    }
    
    return $initialList;
}


function reverseLastTwoDigitsOfEverySplit($initialList) {
    for($i=2; $i< count($initialList) ; $i +=4) {
        $initialList[$i] = $initialList[$i] + $initialList[$i+1];
        $initialList[$i+1] = $initialList[$i] -  $initialList[$i+1];
        $initialList[$i]  = $initialList[$i]- $initialList[$i+1];
    }
    return $initialList;
}
