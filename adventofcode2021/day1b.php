<?php

$depths = explode("\n", trim(file_get_contents('data/day1.txt')));
$increases = -1;
$prevSum = 0;
for($i = 0; $i < count($depths); $i++) {
	if(!isset($depths[$i+2])) {
		break;
	}
	$sum = array_sum([$depths[$i], $depths[$i+1], $depths[$i+2]]);
	if($sum > $prevSum) {
		$increases++;
	}
	$prevSum = $sum;
}
echo "{$increases}\n";
