<?php

function getPriority($type) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return strpos($chars, $type) + 1;
}

$elves = explode("\n", file_get_contents('day3.txt'));

$sum = 0;
for($i = 0; $i < count($elves); $i++) {
	if(empty(trim($elves[$i]))) {
		continue;
	}
	list($as, $bs) = str_split($elves[$i], strlen($elves[$i]) / 2);
	$a = str_split($as);
	$b = str_split($bs);
	$common = '';
	for($j = 0; $j < count($a); $j++) {
		if(in_array($a[$j], $b)) {
			$common = $a[$j];
			break;
		}
	}
	$sum += getPriority($common);
}
print "Sum of the priorities is {$sum}\n";
