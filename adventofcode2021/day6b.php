<?php

// Code from part 1 OOM'ed my 32GB server, had to find another way :D

$fish = explode(',', trim(file_get_contents('data/day6.txt')));

$newFishes = [];
$fishes = [];
for($i = 0; $i < count($fish); $i++) {
	$f = $fish[$i];
	if(!isset($fishes[$f])) {
		$fishes[$f] = 1;
	} else {
		$fishes[$f]++;
	}
}

for($day = 1; $day <= 256; $day++) {
	for($j = 0; $j <= max(array_keys($fishes)); $j++) {
		if(!isset($fishes[$j])) {
			continue;
		}
		if(0 === $j) {
			$newFishes[8] = $fishes[$j];
			$newFishes[6] = $fishes[$j];
		} else {
			if(!isset($newFishes[$j - 1])) {
				$newFishes[$j - 1] = $fishes[$j];
			} else {
				$newFishes[$j - 1] += $fishes[$j];
			}
		}
	}
	$fishes = $newFishes;
	$newFishes = [];
}
$total = 0;
for($i = 0; $i < count($fishes); $i++) {
	$total += $fishes[$i];
}
print "{$total}\n";
