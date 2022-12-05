<?php

function parseRow(string $row): array {
	list($start, $end) = explode(' -> ', $row);
	list($x1, $y1) = explode(',', $start);
	list($x2, $y2) = explode(',', $end);
	return [
		'x1' => min((int)$x1, (int)$x2),
		'y1' => min((int)$y1, (int)$y2),
		'x2' => max((int)$x1, (int)$x2),
		'y2' => max((int)$y1, (int)$y2),
	];
}
function addSegmentLine(array $grid, array $row): array {
	for($y = $row['y1']; $y <= $row['y2']; $y++) {
		for($x = $row['x1']; $x <= $row['x2']; $x++) {
			if(!isset($grid[$y])) {
				$grid[$y] = [];
			}
			if(!isset($grid[$y][$x])) {
				$grid[$y][$x] = 1;
			} else {
				$grid[$y][$x]++;
			}
		}
	}
	return $grid;
}
function calculateOverlaps(array $grid): int {
	$counter = 0;
	for($y = 0; $y <= max(array_keys($grid)); $y++) {
		if(!isset($grid[$y])) {
			continue;
		}
		for($x = 0; $x <= max(array_keys($grid[$y])); $x++) {
			if(!isset($grid[$y][$x])) {
				continue;
			}
			if($grid[$y][$x] >= 2) {
				$counter++;
			}
		}
	}
	return $counter;
}

$rows = explode("\n", trim(file_get_contents('data/day5.txt')));
$grid = [];
for($i = 0; $i < count($rows); $i++) {
	$row = parseRow($rows[$i]);
	if($row['x1'] === $row['x2'] || $row['y1'] === $row['y2']) {
		$grid = addSegmentLine($grid, $row);
	}
}
print calculateOverlaps($grid) . "\n";
