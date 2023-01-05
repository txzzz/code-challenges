<?php

function isValidPassword(string $password, string $letter, array $range): bool {
	$occurances = substr_count($password, $letter);
	return $occurances >= $range[0] && $occurances <= $range[1];
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
	if(isValidPassword($passwords[$i]['password'], $passwords[$i]['letter'], $passwords[$i]['range'])) {
		$n++;
	}
}

print "$n\n";
