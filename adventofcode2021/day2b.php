<?php

$commands = explode("\n", trim(file_get_contents('data/day2.txt')));
$horizontal = 0;
$depth = 0;
$aim = 0;
while(count($commands)) {
	$command = array_shift($commands);
	list($direction, $num) = explode(' ', $command);
	switch($direction) {
		case 'forward':
			$horizontal += $num;
			$depth += ($aim * $num);
			break;
		case 'down': $aim += $num; break;
		case 'up': $aim -= $num; break;
	}
}
print ($depth * $horizontal) . "\n";
