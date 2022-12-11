<?php

$commands = explode("\n", trim(file_get_contents('data/day10.txt')));

$v = [];
$cycle = 1;
for($i = 0; $i < count($commands); $i++) {
	$command = explode(' ', $commands[$i]);
	if('addx' === $command[0]) {
		$cycle += 2;
		$v[$cycle] = (int)$command[1];
	} else if('noop' === $command[0]) {
		$cycle++;
	}
}
$total = 0;
$x = 1;
for($cycle = 1; $cycle <= 220; $cycle++) {
	if(isset($v[$cycle])) {
		 $x += $v[$cycle];
	}
	if(in_array($cycle, [20, 60, 100, 140, 180, 220])) {
		$total += ($x * $cycle);
	}
}
print "{$total}\n";

