<?php

$stairs = trim(file_get_contents('data/day1.txt'));
$floors = 0;
$basement = false;
for($i = 0; $i < strlen($stairs); $i++) {
	switch($stairs[$i]) {
		case '(': $floors++; break;
		case ')': $floors--; break;
	}
	if(-1 === $floors && !$basement) {
		$basement = true;
		print 'Basement reached at character ' . ($i + 1) . "\n";
	}
}
print "Ending floor {$floors}\n";
