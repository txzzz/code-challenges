<?php

$output = explode("\n", trim(file_get_contents('data/day7.txt')));
$output = array_map('trim', $output);

$path = '';
$sizes = [];
for($i = 0; $i < count($output); $i++) {
	if('$' === $output[$i][0]) {
		if(substr($output[$i], 0, 4) === '$ cd') {
			$cd = substr($output[$i], 5);
			if('/' === $cd[0]) {
				$path = "";
			} else if('..' === $cd) {
				$path = substr($path, 0, strrpos($path, '/'));
			} else {
				$path .= "/{$cd}";
			}
		}
	} else {
		if(!isset($sizes[$path])) {
			$sizes[$path] = 0;
		}
		if(in_array($output[$i][0], [1, 2, 3, 4, 5, 6, 7, 8, 9])) {
			$dirs = explode('/', $path);
			for($d = count($dirs); $d > 0; $d--) {
				$p = implode('/', array_slice($dirs, 0, $d));
				if(!isset($sizes[$p])) {
					$sizes[$p] = 0;
				}
				$sizes[$p] += (int)substr($output[$i], 0, strpos($output[$i], ' '));
			}
		}
	}
}
$total = 0;
foreach($sizes as $path => $size) {
	if($size <= 100000) {
		$total += $size;
	}
}
print "$total\n";
