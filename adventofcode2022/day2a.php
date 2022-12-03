<?php

function getScoreFromChoice($choice) {
	switch($choice) {
		case 'A':
		case 'X': return 1;
		case 'B':
		case 'Y': return 2;
		case 'C':
		case 'Z': return 3;
	}
}
function isWinner($a, $b) {
	if(1 === $a && 3 === $b) {
		return true;
	} else if(2 === $a && 1 === $b) {
		return true;
	} else if(3 === $a && 2 === $b) {
		return true;
	}
	return false;
}

$rounds = explode("\n", file_get_contents('data/day2.txt'));

$myTotalScore = 0;
$opponentTotalScore = 0;
for($i = 0; $i < count($rounds); $i++) {
	if(empty(trim($rounds[$i]))) {
		continue;
	}
	list($opponent, $me) = explode(' ', $rounds[$i]);
	$myScore = getScoreFromChoice($me);
	$opponentScore = getScoreFromChoice($opponent);
	if(isWinner($myScore, $opponentScore)) {
		$myScore += 6;
	} else if(isWinner($opponentScore, $myScore)) {
		$opponentScore += 6;
	} else {
		$myScore += 3;
		$opponentScore += 3;
	}
	$myTotalScore += $myScore;
	$opponentTotalScore += $opponentScore;
}

print "My total score: {$myTotalScore}\n";
print "Opponents total score: {$opponentTotalScore}\n";
