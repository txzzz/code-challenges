<?php

function isValidPassword(string $password, string $letter, int $posA, int $posB): bool {
	return $password[$posA - 1] === $letter xor $password[$posB - 1] === $letter;
}

$lines = explode("\n", trim(file_get_contents('data/day2.txt')));
$passwords = [];
for($i = 0; $i < count($lines); $i++) {
	list($policy, $password) = explode(': ', $lines[$i]);
	list($range, $letter) = explode(' ', $policy);
	$passwords[] = [
		'password' => $password,
		'letter'   => $letter,
		'range'    => explode('-', $range),
	];
}
for($i = 0, $n = 0; $i < count($passwords); $i++) {
	if(isValidPassword($passwords[$i]['password'], $passwords[$i]['letter'], $passwords[$i]['range'][0], $passwords[$i]['range'][1])) {
		$n++;
	}
}

print "$n\n";
