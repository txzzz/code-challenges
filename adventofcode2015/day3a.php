<?php

$directions = trim(file_get_contents('data/day3.txt'));
$presentLocations = ['0:0'];
for($i = 0, $y = 0, $x = 0; $i < strlen($directions); $i++) {
	switch($directions[$i]) {
		case '^': $y++; break;
		case 'v': $y--; break;
		case '<': $x--; break;
		case '>': $x++; break;
	}
	$location = "{$x}:{$y}";
	if(!in_array($location, $presentLocations)) {
		$presentLocations[] = $location;
	}
}
print count($presentLocations) . "\n";
