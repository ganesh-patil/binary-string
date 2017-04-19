<?php
ini_set('memory_limit', '1024M');
function getList($n) {
echo 'Initial: ' . memory_get_peak_usage() . " bytes\n";
$initial_mystery_codes = new SplFixedArray(2);
$initial_mystery_codes[0] = "0";
$initial_mystery_codes[1] = "1";
 for($j=1; $j < $n; $j++ ) {
     $noOfElements = pow(2, $j+1);
     echo $noOfElements;
    $new_list = new SplFixedArray($noOfElements);
    $start_index = 0;
    $end_index  = count($initial_mystery_codes) - 1;
    $end_index_start = count($initial_mystery_codes);
   for($i=0; $i < count($initial_mystery_codes); $i++) {
    $new_list[$start_index++] = "0".$initial_mystery_codes[$i];
    $new_list[$end_index_start++] = "1".$initial_mystery_codes[$end_index--];
   }
//   ksort($new_list);
   $initial_mystery_codes  = null;
   unset($initial_mystery_codes);
  $initial_mystery_codes = $new_list;
  $new_list = null;
  unset($new_list);
 
  echo 'Peak: ' . memory_get_peak_usage() . " bytes\n";
 }


 print_r($initial_mystery_codes);
echo 'End: ' . memory_get_peak_usage() . " bytes\n";
}

getList(3);