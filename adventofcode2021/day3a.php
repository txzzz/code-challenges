<?php

function getCommonBit(array $group, bool $most): string {
	$mostCommon = array_sum($group) > floor(count($group) / 2);
	return (string)(int)($most ? $mostCommon : !$mostCommon);
}

$rows = explode("\n", trim(file_get_contents('data/day3.txt')));

$groups = [];
for($i = 0; $i < count($rows); $i++) {
	for($j = 0; $j < strlen($rows[$i]); $j++) {
		if(!isset($groups[$j])) {
			$groups[$j] = [];
		}
		$groups[$j][] = $rows[$i][$j];
	}
}
$gamma = '';
$epsilon = '';
for($i = 0; $i < count($groups); $i++) {
	$gamma .= getCommonBit($groups[$i], true);
	$epsilon .= getCommonBit($groups[$i], false);
}
print bindec($gamma) * bindec($epsilon) . "\n";
