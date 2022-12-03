<?php

function getPriority($type) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return strpos($chars, $type) + 1;
}

$elves = explode("\n", trim(file_get_contents('day3.txt')));

$sum = 0;
while(count($elves)) {
	$a = str_split(array_shift($elves));
	$b = str_split(array_shift($elves));
	$c = str_split(array_shift($elves));
	for($i = 0; $i < count($a); $i++) {
		if(in_array($a[$i], $b) && in_array($a[$i], $c)) {
			$sum += getPriority($a[$i]);
			break;
		}
	}
}
print "Total priorities {$sum}\n";
