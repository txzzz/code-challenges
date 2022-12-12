<?php

function derp($str) {
	$new = '';
	$cur = $str[0];
	$num = 0;
	for($i = 0; $i < strlen($str); $i++) {
		if($cur !== $str[$i]) {
			$new .= (string)$num . $cur;
			$cur = $str[$i];
			$num = 1;
		} else {
			$num++;
		}
	}
	return $new . (string)$num . $cur;
}

$str = '1113122113';
for($i = 0; $i < 40; $i++) {
	$str = derp($str);
}

print strlen($str) . "\n";
