<?php

function getEntryThatSumsTo2020(array $expense, int $entry): int|false {
	for($i = 0; $i < count($expense); $i++) {
		if($entry + $expense[$i] === 2020) {
			return $expense[$i];
		}
	}
	return false;
}
function getEntriesThatSumsTo2020(array $expense, int $entry1): array|false {
	for($i = 0; $i < count($expense); $i++) {
		$entry2 = $expense[$i];
		$entry3 = getEntryThatSumsTo2020($expense, $entry1 + $entry2);
		if($entry3 !== false) {
			return [$entry1, $entry2, $entry3];
		}
	}
	return false;
}

$expense = explode("\n", trim(file_get_contents('data/day1.txt')));

for($i = 0; $i < count($expense); $i++) {
	$entries = getEntriesThatSumsTo2020($expense, $expense[$i]);
	if($entries !== false) {
		print array_product($entries) . "\n"; die;
	}
}
