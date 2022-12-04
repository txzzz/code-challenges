<?php

function between($x, $min, $max) {
	return ($x >= $min && $x <= $max);
}

$pairs = explode("\n", trim(file_get_contents('data/day4.txt')));

$contains = 0;
while(count($pairs)) {
	$pair = array_shift($pairs);
	list($a, $b) = explode(',', $pair);
	list($aMin, $aMax) = explode('-', $a);
	list($bMin, $bMax) = explode('-', $b);
	if((between($aMin, $bMin, $bMax) && between($aMax, $bMin, $bMax)) || (between($bMin, $aMin, $aMax) && between($bMax, $aMin, $aMax))) {
		$contains++;
	}
}
print "Fully contains: $contains\n";
