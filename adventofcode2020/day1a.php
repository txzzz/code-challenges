<?php

function getEntryThatSumsTo2020(array $expense, int $entry1): int|false {
	for($i = 0; $i < count($expense); $i++) {
		if($entry1 + $expense[$i] === 2020) {
			return $expense[$i];
		}
	}
	return false;
}

$expense = explode("\n", trim(file_get_contents('data/day1.txt')));

for($i = 0; $i < count($expense); $i++) {
	$entry = getEntryThatSumsTo2020($expense, $expense[$i]);
	if($entry !== false) {
		print $entry * $expense[$i] . "\n"; die;
	}
}
