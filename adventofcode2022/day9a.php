<?php

function isTouching(array &$head, array &$tail): bool {
	return (abs($head['x'] - $tail['x']) < 2) && (abs($head['y'] - $tail['y']) < 2);
}
function moveTailHorizontal(array &$head, array &$tail, array &$tailPositions, string $direction): void {
	if(!isTouching($head, $tail)) {
		switch($direction) {
			case 'R': $tail['x']++; break;
			case 'L': $tail['x']--; break;
		}
		if($head['y'] > $tail['y']) {
			$tail['y']++;
		} else if($head['y'] < $tail['y']) {
			$tail['y']--;
		}
		addTailPosition($tail, $tailPositions);
	}
}
function moveTailVertical(array &$head, array &$tail, array &$tailPositions, string $direction): void {
	if(!isTouching($head, $tail)) {
		switch($direction) {
			case 'U': $tail['y']++; break;
			case 'D': $tail['y']--; break;
		}
		if($head['x'] > $tail['x']) {
			$tail['x']++;
		} else if($head['x'] < $tail['x']) {
			$tail['x']--;
		}
		addTailPosition($tail, $tailPositions);
	}
}
function addTailPosition(array &$tail, array &$tailPositions): void {
	$position = "{$tail['x']}:{$tail['y']}";
	if(!in_array($position, $tailPositions)) {
		$tailPositions[] = $position;
	}
}
function moveHead(array &$head, array &$tail, string $direction, array &$tailPositions, int $steps): void {
	for($i = 0; $i < $steps; $i++) {
		switch($direction) {
			case 'R': $head['x']++; break;
			case 'L': $head['x']--; break;
			case 'U': $head['y']++; break;
			case 'D': $head['y']--; break;
		}
		if('R' === $direction || 'L' === $direction) {
			moveTailHorizontal($head, $tail, $tailPositions, $direction);
		} else {
			moveTailVertical($head, $tail, $tailPositions, $direction);
		}
	}
}

$moves = explode("\n", trim(file_get_contents('data/day9.txt')));

$tailPositions = ['0:0'];
$head = $tail = [
	'x' => 0,
	'y' => 0,
];
for($i = 0; $i < count($moves); $i++) {
	list($direction, $steps) = explode(' ', $moves[$i]);
	moveHead($head, $tail, $direction, $tailPositions, (int)$steps);
}
print count($tailPositions) . "\n";
