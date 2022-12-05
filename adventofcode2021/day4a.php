<?php

function boardInit(string $board): array {
	$rows = explode("\n", $board);
	for($i = 0; $i < count($rows); $i++) {
		$rows[$i] = array_map('trim', str_split($rows[$i], 3));
	}
	return $rows;
}
function markBoard(array $board, string $ball): array {
	for($y = 0; $y < count($board); $y++) {
		for($x = 0; $x < count($board[$y]); $x++) {
			if($board[$y][$x] === $ball) {
				$board[$y][$x] = 'X';
			}
		}
	}
	return $board;
}
function isWinner(array $board): bool {
	for($x = 0; $x < 5; $x++) {
		$col = '';
		for($y = 0; $y < 5; $y++) {
			$col .= $board[$y][$x];
		}
		if($col === 'XXXXX') {
			return true;
		}
	}
	for($y = 0; $y < 5; $y++) {
		if(implode('', $board[$y]) === 'XXXXX' || $col === 'XXXXX') {
			return true;
		}
	}
	return false;
}
function calculateScore(array $board): int {
	$score = 0;
	for($y = 0; $y < 5; $y++) {
		for($x = 0; $x < 5; $x++) {
			if($board[$y][$x] !== 'X') {
				$score += (int)$board[$y][$x];
			}
		}
	}
	return $score;
}

list($balls, $boards) = explode("\n\n", trim(file_get_contents('data/day4.txt')), 2);
$balls = explode(',', $balls);
$boards = explode("\n\n", $boards);
$boards = array_map('boardInit', $boards);
for($i = 0; $i < count($balls); $i++) {
	for($j = 0; $j < count($boards); $j++) {
		$boards[$j] = markBoard($boards[$j], $balls[$i]);
		if(isWinner($boards[$j])) {
			print (calculateScore($boards[$j]) * $balls[$i]) . "\n";
			break 2;
		}
	}
}
