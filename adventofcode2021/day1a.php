<?php

$depths = explode("\n", trim(file_get_contents('data/day1.txt')));
$increases = -1;
$lastDepth = 0;
while(count($depths)) {
	$depth = array_shift($depths);
	if($depth > $lastDepth) {
		$increases++;
	}
	$lastDepth = $depth;
}
echo "{$increases}\n";
