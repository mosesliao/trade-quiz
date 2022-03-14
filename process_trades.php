<?php
$trades = array_map( 'str_getcsv', file( $argv[1] ) );
$output1 = [];
$output = [];
// get unique keys
foreach ($trades as $trade) {
  $output1[$trade[1]] = [0,0,0,$trade[3], 0, 0] ;
}
// get the total
foreach ($trades as $trade) {
  if ($output1[$trade[1]][5] == 0) {
    $output1[$trade[1]][5] = $trade[2]*$trade[3];
  } else {
    $output1[$trade[1]][5] += $trade[2]*$trade[3];
  }
}
ksort($output1);

// max time
foreach ($trades as $trade2) {
  if ($output1[$trade2[1]][4] > 0) {
    $trade_time = $trade2[0] - $output1[$trade2[1]][4];
    if($trade_time > $output1[$trade2[1]][0]) $output1[$trade2[1]][0] = $trade_time;
  }
  $output1[$trade2[1]][4] = $trade2[0]; // Time
  $output1[$trade2[1]][1] += $trade2[2]; // Volume
  $output1[$trade2[1]][2] = $trade2[3]; // weighted avg price
  if ($trade2[3] > $output1[$trade2[1]][3])
    $output1[$trade2[1]][3] = $trade2[3]; // max price
}
foreach ($output1 as $key => $value) {
  $output[] = [
    $key, $value[0], $value[1], round($value[5] / $value[1]), $value[3]
  ];
}
// print_r($output);
// Open a file in write mode ('w')
$fp = fopen($argv[2], 'w');

// Loop through file pointer and a line
foreach ($output as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
