<?php

$characters = str_split(trim(file_get_contents('data/day6.txt')));

$range = array_slice($characters, 0, 14);
for($i = 14; $i <= count($characters); $i++) {
	if(count(array_unique($range)) === 14) {
		print "$i\n";
		break;
	}
	array_shift($range);
	array_push($range, $characters[$i]);
}
