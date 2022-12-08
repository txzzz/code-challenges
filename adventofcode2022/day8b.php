<?php

function calculateScenicScore(array $trees, int $y, int $x): int {
	$westVisibility = 0;
	$northVisibility = 0;
	$southVisibility = 0;
	$eastVisibility = 0;
	$currentTree = (int)$trees[$y][$x];
	for($i = $x + 1; $i < strlen($trees[0]); $i++) {
		$eastVisibility++;
		if((int)$trees[$y][$i] >= $currentTree) {
			break;
		}
	}
	for($i = $x - 1; $i >= 0; $i--) {
		$westVisibility++;
		if((int)$trees[$y][$i] >= $currentTree) {
			break;
		}
	}
	for($i = $y + 1; $i < count($trees); $i++) {
		$southVisibility++;
		if((int)$trees[$i][$x] >= $currentTree) {
			break;
		}
	}
	for($i = $y - 1; $i >= 0; $i--) {
		$northVisibility++;
		if((int)$trees[$i][$x] >= $currentTree) {
			break;
		}
	}
	return $westVisibility * $northVisibility * $southVisibility * $eastVisibility;
}

$forest = explode("\n", trim(file_get_contents('data/day8.txt')));

$highest = 0;
for($y = 0; $y < count($forest); $y++) {
	for($x = 0; $x < strlen($forest[$y]); $x++) {
		$score = calculateScenicScore($forest, $y, $x);
		if($score > $highest) {
			$highest = $score;
		}
	}
}

print "{$highest}\n";
