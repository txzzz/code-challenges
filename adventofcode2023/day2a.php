<?php

$games = explode("\n", trim(file_get_contents('data/day2.txt')));

$red = 12;
$green = 13;
$blue = 14;

$sum = 0;

for($i = 0; $i < count($games); $i++) {
	list($game, $hands) = explode(': ', $games[$i]);
	$game = (int)explode(' ', $game)[1];
	$hands = explode('; ', $hands);
	for($j = 0; $j < count($hands); $j++) {
		$cubes = explode(', ', $hands[$j]);
		for($k = 0; $k < count($cubes); $k++) {
			list($amount, $color) = explode(' ', $cubes[$k]);
			$amount = (int)$amount;
			if($$color < $amount) {
				continue 3;
			}
		}
	}
	$sum += $game;
}

echo "$sum\n";
