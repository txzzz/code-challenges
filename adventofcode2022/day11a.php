<?php

$lines = explode("\n", trim(file_get_contents('data/day11.txt')));
$monkeys = [];
for($i = 0; $i < 8; $i++) {
	$monkey = array_slice($lines, $i*7, 7);
	$n = $monkey[0][7];
	$monkeys[$n] = [
		'items'     => explode(', ', trim(substr($monkey[1], 17))),
		'operation' => trim(substr($monkey[2], 25)),
		'operator'  => substr($monkey[2], 23, 1),
		'test'      => (int)trim(substr($monkey[3], 20)),
		'if-true'   => (int)trim(substr($monkey[4], 28)),
		'if-false'  => (int)trim(substr($monkey[5], 29)),
		'inspected' => 0,
	];
	$monkeys[$n]['items'] = array_map('intval', $monkeys[$n]['items']);
}

for($round = 0; $round < 20; $round++) {
	for($monkey = 0; $monkey < count($monkeys); $monkey++) {
		for($i = 0; count($monkeys[$monkey]['items']) && $i <= max(array_keys($monkeys[$monkey]['items'])); $i++) {
			$monkeys[$monkey]['inspected']++;
			switch($monkeys[$monkey]['operator']) {
				case '*': $monkeys[$monkey]['items'][$i] *= ('old' === $monkeys[$monkey]['operation'] ? $monkeys[$monkey]['items'][$i] : (int)$monkeys[$monkey]['operation']); break;
				case '+': $monkeys[$monkey]['items'][$i] += ('old' === $monkeys[$monkey]['operation'] ? $monkeys[$monkey]['items'][$i] : (int)$monkeys[$monkey]['operation']); break;
			}
			$monkeys[$monkey]['items'][$i] = floor($monkeys[$monkey]['items'][$i] / 3);
			if($monkeys[$monkey]['items'][$i] % $monkeys[$monkey]['test'] === 0) {
				$newMonkey = $monkeys[$monkey]['if-true'];
			} else {
				$newMonkey = $monkeys[$monkey]['if-false'];
			}
			$monkeys[$newMonkey]['items'][] = $monkeys[$monkey]['items'][$i];
			unset($monkeys[$monkey]['items'][$i]);
		}
		$monkeys[$monkey]['items'] = array_values($monkeys[$monkey]['items']);
	}
}
$timesInspected = [];
for($i = 0; $i < count($monkeys); $i++) {
	$timesInspected[] = $monkeys[$i]['inspected'];
}
rsort($timesInspected);
print ($timesInspected[0] * $timesInspected[1]) . "\n";
