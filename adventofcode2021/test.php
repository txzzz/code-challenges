<?php

$foo = [
	[0,0,0,0],
	[0,0,0,0],
	[0,0,0,0],
	[0,0,0,0],
];
$xs = 1;
$xe = 4;
$ys = 3;
$ye = 6;

for($y = $ys, $x = $xs;; ($ys < $ye ? $y++ : $y--), ($xs < $xe ? $x++ : $x--)) {
	print "$y:$x\n";
	if($y === $ye || $x === $xe) {
		break;
	}
	/*
	if($xs === $xe || $ys === $ye) {
		break;
	}
	 */
//	if($xs 
}
