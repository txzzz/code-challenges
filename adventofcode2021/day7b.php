<?php

function calculateFuel(array $crabs, int $position): int {
	$fuel = 0;
	for($i = 0; $i < count($crabs); $i++) {
		$fuel += fuelIncrease(abs($position - $crabs[$i]));
	}
	return $fuel;
}
function fuelIncrease(int $steps): int {
	$fuel = 0;
	for($i = 1; $i <= $steps; $i++) {
		$fuel += $i;
	}
	return $fuel;
}

$crabs = explode(',', trim(file_get_contents('data/day7.txt')));
for($i = 0; $i < count($crabs); $i++) {
	$crabs[$i] = (int)$crabs[$i];
}

for($i = 0; $i <= max($crabs); $i++) {
	if(!isset($crabs[$i])) {
		continue;
	}
	$fuel = calculateFuel($crabs, $i);
	if(!isset($lowestFuel) || $fuel < $lowestFuel) {
		$lowestFuel = $fuel;
	}
}
print "{$lowestFuel}\n";
