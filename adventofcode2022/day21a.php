<?php

$lines = explode("\n", trim(file_get_contents('data/day21.txt')));

$monkeys = [];
for($i = 0; $i < count($lines); $i++) {
	list($monkey, $number) = explode(': ', $lines[$i]);
	if(is_numeric($number)) {
		$number = (int)$number;
	} else {
		list($monkey1, $operator, $monkey2) = explode(' ', $number);
		$number = [
			'monkey1'  => $monkey1,
			'monkey2'  => $monkey2,
			'operator' => $operator,
		];
	}
	$monkeys[$monkey] = $number;
}
$monkeyNames = array_keys($monkeys);
for($i = 0, $c = count($monkeyNames); $i < $c; $i++) {
	if(gettype($monkeys[$monkeyNames[$i]]) === 'array') {
		$monkey1 = $monkeys[$monkeyNames[$i]]['monkey1'];
		$monkey2 = $monkeys[$monkeyNames[$i]]['monkey2'];
		if(gettype($monkeys[$monkey1]) === 'integer' && gettype($monkeys[$monkey2]) === 'integer') {
			switch($monkeys[$monkeyNames[$i]]['operator']) {
				case '+': $number = (int)($monkeys[$monkey1] + $monkeys[$monkey2]); break;
				case '/': $number = (int)($monkeys[$monkey1] / $monkeys[$monkey2]); break;
				case '*': $number = (int)($monkeys[$monkey1] * $monkeys[$monkey2]); break;
				case '-': $number = (int)($monkeys[$monkey1] - $monkeys[$monkey2]); break;
			}
			$monkeys[$monkeyNames[$i]] = $number;
			if('root' === $monkeyNames[$i]) {
				print "{$number}\n";
				break;
			}
		}
	}
	if($i === $c - 1) {
		$i = 0;
	}
}
