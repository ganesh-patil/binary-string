<?php
ini_set('memory_limit', '1024M');
function getList($n) {
echo 'Initial: ' . memory_get_peak_usage() . " bytes\n";
$initial_mystery_codes = array("0","1");
 for($j=1; $j < $n; $j++ ) {
   $new_list = null;
    $start_index = 0;
    $end_index  = count($initial_mystery_codes) - 1;
    
    $end_index_start = count($initial_mystery_codes);
    echo $end_index_start;
   for($i=0; $i < count($initial_mystery_codes); $i++) {
    $new_list[$start_index++] = "0".$initial_mystery_codes[$i];
    $new_list[$end_index_start++] = "1".$initial_mystery_codes[$end_index--];
   }
   ksort($new_list);
  $initial_mystery_codes = $new_list;
 
  echo 'Peak: ' . memory_get_peak_usage() . " bytes\n";
 }


// print_r($initial_mystery_codes);
 $initial_mystery_codes = array_chunk($initial_mystery_codes, $n);
// $initial_mystery_codes = array_chunk($initial_mystery_codes, count($initial_mystery_codes)/2);
 foreach($initial_mystery_codes[0] as $codes) {
     $binary = substr($codes, 1);
//     echo bindec($binary) . "\n"; 
     $final_array[] = bindec($binary);
 }
 var_export($final_array);
echo 'End: ' . memory_get_peak_usage() . " bytes\n";
}

getList(21);