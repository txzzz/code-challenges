<?php

$json = trim(file_get_contents('data/day12.txt'));
$recordNumber = false;
$digits = str_split('-0123456789');
$number = '';
for($i = 0, $sum = 0; $i < strlen($json); $i++) {
	if(in_array($json[$i], $digits)) {
		$recordNumber = true;
		$number .= $json[$i];
	} else if($recordNumber) {
		$recordNumber = false;
		$sum += (int)$number;
		$number = '';
	}
}
print "{$sum}\n";
