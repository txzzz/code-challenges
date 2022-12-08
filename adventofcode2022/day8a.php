<?php

function registerVisibility(array &$trees, int $y, int $x): void {
	if(!isset($trees[$y])) {
		$trees[$y] = [];
	}
	$trees[$y][$x] = true;
}
function isRegistered(array $trees, int $y, int $x): bool {
	return isset($trees[$y]) && isset($trees[$y][$x]);
}

$forest = explode("\n", trim(file_get_contents('data/day8.txt')));

$treeCount = 0;
$registeredTrees = [];
for($x = 1; $x < strlen($forest[0]) - 1; $x++) {
	$highest = -1;
	for($y = 0; $y < count($forest); $y++) {
		$height = (int)$forest[$y][$x];
		if($height > $highest) {
			$highest = $height;
			if(!isRegistered($registeredTrees, $y, $x)) {
				registerVisibility($registeredTrees, $y, $x);
				$treeCount++;
			}
		}
		if(9 === $highest) {
			break;
		}
	}
}
for($x = 1; $x < strlen($forest[0]) - 1; $x++) {
	$highest = -1;
	for($y = count($forest) - 1; $y >= 0; $y--) {
		$height = (int)$forest[$y][$x];
		if($height > $highest) {
			$highest = $height;
			if(!isRegistered($registeredTrees, $y, $x)) {
				registerVisibility($registeredTrees, $y, $x);
				$treeCount++;
			}
		}
		if(9 === $highest) {
			break;
		}
	}
}
for($y = 1; $y < count($forest) - 1; $y++) {
	$highest = -1;
	for($x = 0; $x < strlen($forest[$y]); $x++) {
		$height = (int)$forest[$y][$x];
		if($height > $highest) {
			$highest = $height;
			if(!isRegistered($registeredTrees, $y, $x)) {
				registerVisibility($registeredTrees, $y, $x);
				$treeCount++;
			}
		}
		if(9 === $highest) {
			break;
		}
	}
}
for($y = 1; $y < count($forest) - 1; $y++) {
	$highest = -1;
	for($x = strlen($forest[$y]) - 1; $x >= 0; $x--) {
		$height = (int)$forest[$y][$x];
		if($height > $highest) {
			$highest = $height;
			if(!isRegistered($registeredTrees, $y, $x)) {
				registerVisibility($registeredTrees, $y, $x);
				$treeCount++;
			}
		}
		if(9 === $highest) {
			break;
		}
	}
}
$treeCount += 4;
print "{$treeCount}\n";
