<?php

function putCrateInPile(array &$piles, int $n, string $crate): void {
	if(!isset($piles[$n])) {
		$piles[$n] = [];
	}
	$piles[$n][] = $crate;
}
function removeCrateFromPile(array &$piles, int $n): string {
	if(!isset($piles[$n]) || !count($piles[$n])) {
		return false;
	}
	$crate = getCrateFromPile($piles, $n);
	unset($piles[$n][max(array_keys($piles[$n]))]);
	$piles[$n] = array_values($piles[$n]);
	return $crate;
}
function getCrateFromPile(array &$piles, int $n): false|string {
	if(!isset($piles[$n])) {
		return false;
	}
	return $piles[$n][max(array_keys($piles[$n]))];
}
function parseAction(string $action): array {
	list(, $n,, $from,, $to) = explode(' ', $action);
	return [
		'from' => $from,
		'to'   => $to,
		'n'    => $n,
	];
}

list($crates, $actions) = explode("\n\n", trim(file_get_contents('data/day5.txt')));
$rows = explode("\n", $crates);
$piles = [];
for($i = count($rows) - 2; $i >= 0; $i--) {
	$crates = str_split($rows[$i], 4);
	$crates = array_map('trim', $crates);
	for($j = 0; $j < count($crates); $j++) {
		if(empty(trim($crates[$j]))) {
			continue;
		}
		putCrateInPile($piles, $j + 1, $crates[$j][1]);
	}
}
$actions = explode("\n", $actions);
for($i = 0; $i < count($actions); $i++) {
	$action = parseAction($actions[$i]);
	for($j = 0; $j < $action['n']; $j++) {
		$crate = removeCrateFromPile($piles, $action['from']);
		putCrateInPile($piles, $action['to'], $crate);
	}
}
$code = '';
for($i = 1; $i <= count($piles); $i++) {
	$code .= removeCrateFromPile($piles, $i);
}
print "$code\n";
