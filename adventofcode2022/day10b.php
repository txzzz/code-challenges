<?php

function getRowFromCycle(int $cycle): int {
	return floor(($cycle - 1) / 40);
}
function getPixelFromCycle(int $cycle): int {
	return (($cycle - 1) % 40);
}

function isVisible(int $x, int $cycle): bool {
	$pixel = getPixelFromCycle($cycle) + 1;
	return ($pixel <= $x + 2 && $pixel >= $x);
}

$row = array_fill(0, 40, []);
$screen = array_fill(0, 6, $row);

$commands = explode("\n", trim(file_get_contents('data/day10.txt')));
$instructions = array_fill(1, 250, []);

$v = [];
$cycle = 1;
for($i = 0; $i < count($commands); $i++) {
	$command = explode(' ', $commands[$i]);
	if('addx' === $command[0]) {
		$instructions[$cycle][] = 'addx start';
		$instructions[$cycle + 1][] = 'addx continue';
		$cycle += 2;
		$instructions[$cycle][] = "addx finish {$command[1]}";
		$v[$cycle] = (int)$command[1];
	} else if('noop' === $command[0]) {
		$instructions[$cycle][] = "noop";
		$cycle++;
	}
}
$total = 0;
$x = 1;
$addx = 0;
for($cycle = 1; $cycle <= 240; $cycle++) {
	$row = getRowFromCycle($cycle);
	$pixel = getPixelFromCycle($cycle);
	for($i = 0; $i < count($instructions[$cycle]); $i++) {
		if(strpos($instructions[$cycle][$i], 'addx start') !== false) {
			$screen[$row][$pixel] = isVisible($x, $cycle) ? '#' : '.';
		} else if(strpos($instructions[$cycle][$i], 'addx continue') !== false) {
			$screen[$row][$pixel] = isVisible($x, $cycle) ? '#' : '.';
		} else if(strpos($instructions[$cycle][$i], 'addx finish') !== false) {
			$x += (int)substr($instructions[$cycle][$i], 12);
			$screen[$row][$pixel] = isVisible($x, $cycle) ? '#' : '.';
		} else if(strpos($instructions[$cycle][$i], 'noop') !== false) {
			$screen[$row][$pixel] = isVisible($x, $cycle) ? '#' : '.';
		}
	}
}
for($y = 0; $y < 6; $y++) {
	for($x = 0; $x < 40; $x++) {
		print $screen[$y][$x];
	}
	print "\n";
}
