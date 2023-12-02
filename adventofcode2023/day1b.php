<?php

$search = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
$replace = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

$lines = explode("\n", trim(file_get_contents('data/day1.txt')));
$total = 0;
for($i = 0; $i < count($lines); $i++) {
	preg_match_all('/(?=(one|two|three|four|five|six|seven|eight|nine|[0-9]))/', $lines[$i], $matches);
	$number = $matches[1][0] . $matches[1][count($matches[1]) - 1];
	$number = (int)str_replace($search, $replace, $number);
	$total += $number;
}
echo "$total\n";
