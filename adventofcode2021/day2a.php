<?php

$commands = explode("\n", trim(file_get_contents('data/day2.txt')));
$horizontal = 0;
$depth = 0;
while(count($commands)) {
	$command = array_shift($commands);
	list($direction, $num) = explode(' ', $command);
	switch($direction) {
		case 'forward': $horizontal += $num; break;
		case 'down': $depth += $num; break;
		case 'up': $depth -= $num; break;
	}
}
print ($depth * $horizontal) . "\n";
