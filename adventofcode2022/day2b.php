<?php

function getScoreFromChoice($choice) {
	switch($choice) {
		case 'A': return 1;
		case 'B': return 2;
		case 'C': return 3;
	}
}
function getScoreIfLoss($opponent) {
	if(1 === $opponent) {
		return 3;
	}
	return --$opponent;
}
function getScoreIfDraw($opponent) {
	return $opponent + 3;
}
function getScoreIfWin($opponent) {
	if(3 === $opponent) {
		return 7;
	}
	return ++$opponent + 6;
}

$rounds = explode("\n", file_get_contents('data/day2.txt'));

$myTotalScore = 0;
for($i = 0; $i < count($rounds); $i++) {
	if(empty(trim($rounds[$i]))) {
		continue;
	}
	list($opponent, $outcome) = explode(' ', $rounds[$i]);
	$opponentScore = getScoreFromChoice($opponent);
	switch($outcome) {
		case 'X': $myScore = getScoreIfLoss($opponentScore); break;
		case 'Y': $myScore = getScoreIfDraw($opponentScore); break;
		case 'Z': $myScore = getScoreIfWin($opponentScore); break;
	}
	$myTotalScore += $myScore;
}

print "My total score: {$myTotalScore}\n";
