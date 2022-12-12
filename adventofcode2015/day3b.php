<?php

$directions = trim(file_get_contents('data/day3.txt'));
$presentLocations = ['0:0'];
$roboSanta = $santa = [
	'x' => 0,
	'y' => 0,
];
for($i = 0; $i < strlen($directions); $i++) {
	if($i % 2) {
		$location = $roboSanta;
	} else {
		$location = $santa;
	}
	switch($directions[$i]) {
		case '^': $location['y']++; break;
		case 'v': $location['y']--; break;
		case '<': $location['x']--; break;
		case '>': $location['x']++; break;
	}
	$l = "{$location['x']}:{$location['y']}";
	if(!in_array($l, $presentLocations)) {
		$presentLocations[] = "{$location['x']}:{$location['y']}";
	}
	if($i % 2) {
		$roboSanta = $location;
	} else {
		$santa = $location;
	}
}
print count($presentLocations) . "\n";
