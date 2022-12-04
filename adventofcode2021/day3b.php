<?php

function getCommonBit(array $group, bool $most): string {
	$mostCommon = array_sum($group) >= floor(count($group) / 2);
	return (string)(int)($most ? $mostCommon : !$mostCommon);
}
function filterByBit(array $array, int $position, string $type) {
	$bits = [];
	for($i = 0; $i <= max(array_keys($array)); $i++) {
		if(!isset($array[$i])) {
			continue;
		}
		$bits[] = $array[$i][$position];
	}
	$mostCommonBit = getCommonBit($bits, true);
	for($i = 0; $i <= max(array_keys($array)); $i++) {
		if(!isset($array[$i])) {
			continue;
		}
		if(count($array) === 1) {
			break;
		}
		if($array[$i][$position] !== $mostCommonBit && 'oxygen' === $type) {
			unset($array[$i]);
		} else if($array[$i][$position] === $mostCommonBit && 'scrubber' === $type) {
			unset($array[$i]);
		}
	}
	return $array;
}

$rows = explode("\n", trim(file_get_contents('data/day3.txt')));

$oxygen = $rows;
$scrubber = $rows;
for($i = 0; $i < strlen($rows[0]); $i++) {
	$oxygen = filterByBit($oxygen, $i, 'oxygen');
	$scrubber = filterByBit($scrubber, $i, 'scrubber');
}
print bindec(array_values($oxygen)[0]) * bindec(array_values($scrubber)[0]) . "\n";
