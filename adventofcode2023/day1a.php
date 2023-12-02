<?php

$lines = explode("\n", trim(file_get_contents('data/day1.txt')));
$total = 0;
for($i = 0; $i < count($lines); $i++) {
	$digits = str_split(preg_replace('/[a-z]/i', '', $lines[$i]));
	$digits_count = (count($digits) - 1);
	$total += (int)"${digits[0]}${digits[$digits_count]}";
}

echo "$total\n";
