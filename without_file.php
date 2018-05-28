<?php 
ini_set('memory_limit','1M');
function getList($n) {
echo 'Initial: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes\n";
$initial_mystery_codes = array("0","1");
 for($j=1; $j < $n; $j++ ) {
   $new_list = null;
   //foreach($initial_mystery_codes as $element) {
    $index = 0;
   for($i=0; $i < count($initial_mystery_codes); $i++) {
    $new_list[$index++] = "0".$initial_mystery_codes[$i];
   }
 $initial_mystery_codes = array_reverse($initial_mystery_codes);
 // foreach($initial_mystery_codes as $element) {
   for($i=0; $i < count($initial_mystery_codes); $i++) {
    $new_list[$index++] = pack("a","1".$initial_mystery_codes[$i]);
   }
$initial_mystery_codes = null;
 unset($initial_mystery_codes);
  $initial_mystery_codes = $new_list;
 // $new_list = null;
  echo 'Peak: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes\n"; 
 }

$ignore_list = count($initial_mystery_codes) - $n;
for($i=$ignore_list; $i< count($initial_mystery_codes); $i++){

    echo $initial_mystery_codes[$i]."\n";
}
echo 'End: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes\n";
}

getList(6);
