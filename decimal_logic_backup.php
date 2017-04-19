<?php
ini_set('memory_limit','1024M');
$n = 10;
$list = array(0);
$maxExponent = pow(2, $n)/2;
//var_dump($maxExponent);die;
for($i=0; $i< $n; $i++){
    $list = array_merge($list,getList(pow(2, $i)));
    if(count($list) >= $maxExponent) {
        break;
    }
//    var_dump($list);
}
var_export($list);

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
    
   // $finalList = array_reverse($finalList);
    return $finalList;
}

function getLowerList($number, $max) {
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
        if(count($initialList) < 4) {   //8
        }
        elseif(count($initialList) == 4 ){
            // chunk
            $initialList = reverseLastTwoDigits($initialList);
            
        }
        else {
            $initialList = reverseLastTwoDigitsOfEverySplit($initialList);
            $chunks = array_chunk($initialList, 4);
            $chunks[1] = array_reverse($chunks[1]);  //
            $initialList = null;
            $initialList = array_merge($chunks[0], $chunks[1]);
        }
       
    }
    }
     $initialList = array_reverse($initialList);
    
    return $initialList;
    //5,4
}

function getHigherList($number, $max) {
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
        if(count($initialList) < 4) {
        }
        elseif(count($initialList) == 4 ){
            $initialList = reverseLastTwoDigits($initialList);
        }
        else {
            $initialList = reverseLastTwoDigitsOfEverySplit($initialList);
            $chunks = array_chunk($initialList, 4);
            $chunks[1] = array_reverse($chunks[1]);
             $initialList = null;
             $initialList = array_merge($chunks[0], $chunks[1]);
        }
    }
    
    }
    return $initialList;
    //6,7
}

function reverseLastTwoDigits($initialList){
    $tmp = $initialList[2];
    $initialList[2] = $initialList[3];
    $initialList[3]   =$tmp;
    return $initialList;
}

function reverseLastTwoDigitsOfEverySplit($initialList) {
    $tmp = $initialList[2];
    $initialList[2] = $initialList[3];
    $initialList[3]   =$tmp;
    $tmp = $initialList[6];
    $initialList[6] = $initialList[7];
    $initialList[7]   =$tmp;
    return $initialList;
}
