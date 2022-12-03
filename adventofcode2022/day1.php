<?php

$pieces = file_get_contents('day1.txt');
$pieces = explode("\n", $pieces);

$deer = 0;
$calories = [0];
for($i = 0; $i < count($pieces); $i++) {
	if(empty(trim($pieces[$i]))) {
		$deer++;
		$calories[$deer] = 0;
		continue;
	}
	$calories[$deer] += (int)trim($pieces[$i]);
}
rsort($calories);
print "Part 1: {$calories[0]}\n";
print "Part 2: " . ($calories[0] + $calories[1] + $calories[2]) . "\n";
