<?php

function isTouching(array $previousKnot, array $knot): bool {
	return (abs($previousKnot['x'] - $knot['x']) < 2) && (abs($previousKnot['y'] - $knot['y']) < 2);
}
function moveKnot(array $previousKnot, array &$knots, int $knot, array &$tailPositions): void {
	$right = ($previousKnot['x'] > $knots[$knot]['x']);
	$left = ($previousKnot['x'] < $knots[$knot]['x']);
	$up = ($previousKnot['y'] > $knots[$knot]['y']);
	$down = ($previousKnot['y'] < $knots[$knot]['y']);
	if($right) {
		$knots[$knot]['x']++;
	} else if($left) {
		$knots[$knot]['x']--;
	}
	if($up) {
		$knots[$knot]['y']++;
	} else if($down) {
		$knots[$knot]['y']--;
	}
	if(9 === $knot) {
		addTailPosition($knots[$knot], $tailPositions);
	}
}
function addTailPosition(array $knot, array &$tailPositions): void {
	$position = "{$knot['x']}:{$knot['y']}";
	if(!in_array($position, $tailPositions)) {
		$tailPositions[] = $position;
	}
}
function moveHead(array &$knots, string $direction, array &$tailPositions, int $steps): void {
	for($i = 0; $i < $steps; $i++) {
		switch($direction) {
			case 'R': $knots[0]['x']++; break;
			case 'L': $knots[0]['x']--; break;
			case 'U': $knots[0]['y']++; break;
			case 'D': $knots[0]['y']--; break;
		}
		for($j = 1; $j <= 9; $j++) {
			if(isTouching($knots[$j - 1], $knots[$j])) {
				break;
			}
			moveKnot($knots[$j - 1], $knots, $j, $tailPositions);
		}
	}
}

$moves = explode("\n", trim(file_get_contents('data/day9.txt')));

$tailPositions = ['0:0'];
$knot = [
	'x' => 0,
	'y' => 0,
];

$knots = array_fill(0, 10, $knot);
for($i = 0; $i < count($moves); $i++) {
	list($direction, $steps) = explode(' ', $moves[$i]);
	moveHead($knots, $direction, $tailPositions, (int)$steps, $i);
}
print count($tailPositions) . "\n";
