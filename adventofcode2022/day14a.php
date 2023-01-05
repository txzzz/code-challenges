<?php

function parseLine(string $line): array {
	$coordinates = explode(' -> ', trim($line));
	for($i = 0; $i < count($coordinates); $i++) {
		$tmp = explode(',', $coordinates[$i]);
		$coordinates[$i] = [
			'x' => $tmp[0],
			'y' => $tmp[1],
		];
	}
	return $coordinates;
}
function drawLines(array &$grid, array $coordinates): void {
	for($i = 1; $i < count($coordinates); $i++) {
		if($coordinates[$i - 1]['x'] === $coordinates[$i]['x']) {
			for($j = min($coordinates[$i - 1]['y'], $coordinates[$i]['y']); $j <= max($coordinates[$i - 1]['y'], $coordinates[$i]['y']); $j++) {
				if(!isset($grid[$j])) {
					$grid[$j] = [];
				}
				$grid[$j][$coordinates[$i]['x']] = '#';
			}
		} else {
			for($j = min($coordinates[$i - 1]['x'], $coordinates[$i]['x']); $j <= max($coordinates[$i - 1]['x'], $coordinates[$i]['x']); $j++) {
				if(!isset($grid[$coordinates[$i]['y']])) {
					$grid[$coordinates[$i]['y']] = [];
				}
				$grid[$coordinates[$i]['y']][$j] = '#';
			}
		}
	}
}
function printGrid(): void {
	for($y = min(array_keys($grid)); $y <= max(array_keys($grid)); $y++) {
		if(!isset($grid[$y]) || !count($grid[$y])) {
			continue;
		}
		$x = array_keys($grid[$y]);
		if(!isset($lowestX) || $lowestX > min($x)) {
			$lowestX = min($x);
		}
		if(!isset($highestX) || $highestX < max($x)) {
			$highestX = max($x);
		}
	}
	for($x = $lowestX; $x <= $highestX; $x++) {
		if($x === 500) {
			print 'x';
		} else {
			print ' ';
		}
	}
	for($y = min(array_keys($grid)); $y <= max(array_keys($grid)); $y++) {
		for($x = $lowestX; $x <= $highestX; $x++) {
			if(isset($grid[$y][$x])) {
				print $grid[$y][$x];
			} else {
				print ' ';
			}
		}
		print "\n";
	}
}
function dropSand(array &$grid, int $x, bool $track = false): bool {
	$minY = 0;
	$maxY = max(array_keys($grid));
	for($y = $minY, $i = 0; $y <= $maxY; $y++, $i++) {
		if(!isset($grid[$y])) {
			$grid[$y] = [];
			if($track) {
				$grid[$y][$x] = '~';
			}
			continue;
		}
		if(!isset($grid[$y + 1][$x])) {
			if($track) {
				$grid[$y][$x] = '~';
			}
			continue;
		} else {
			if(!isset($grid[$y + 1][$x - 1])) {
				if($track) {
					$grid[$y][$x] = '~';
				}
				$x--;
				continue;
			} else if(!isset($grid[$y + 1][$x + 1])) {
				if($track) {
					$grid[$y][$x] = '~';
				}
				$x++;
				continue;
			} else {
				$grid[$y][$x] = 'o';
				return false;
			}
		}
	}
	$grid[$y][$x] = 'X';
	return true;
}

$lines = explode("\n", trim(file_get_contents('data/day14.txt')));

$grid = [];
for($i = 0; $i < count($lines); $i++) {
	$coordinates = parseLine($lines[$i]);
	drawLines($grid, $coordinates);
}
for($y = 0; $y <= max(array_keys($grid)); $y++) {
	if(!isset($grid[$y])) {
		$grid[$y] = [];
	}
}
for($n = 0; true; $n++) {
	$fallsToTheAbyss = dropSand($grid, 500, false);
	if($fallsToTheAbyss) {
		print "{$n}\n";
		break;
	}
}
