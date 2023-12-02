<?php

$games = explode("\n", trim(file_get_contents('data/day2.txt')));

$sum = 0;

for($i = 0; $i < count($games); $i++) {
	$red = 0;
	$green = 0;
	$blue = 0;
	list(, $hands) = explode(': ', $games[$i]);
	$hands = explode('; ', $hands);
	for($j = 0; $j < count($hands); $j++) {
		$cubes = explode(', ', $hands[$j]);
		for($k = 0; $k < count($cubes); $k++) {
			list($amount, $color) = explode(' ', $cubes[$k]);
			$amount = (int)$amount;
			if($$color < $amount) {
				$$color = $amount;
			}
		}
	}
	$sum += ($red * $green * $blue);
}


echo "$sum\n";
