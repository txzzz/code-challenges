<?php

$fish = explode(',', trim(file_get_contents('data/day6.txt')));

for($day = 1; $day <= 80; $day++) {
	$new = 0;
	for($j = 0; $j < count($fish); $j++) {
		$fish[$j]--;
		if(-1 === $fish[$j]) {
			$fish[$j] = 6;
			$new++;
		}
	}
	if($new > 0) {
		$fish = array_merge($fish, array_fill(0, $new, 8));
	}
}
print count($fish) . "\n";
