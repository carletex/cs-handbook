<?php 

/**
 * Hanoi
 */

function hanoi($n, $start, $helper, $destination) {
	if ($n == 1) {
		print "Move from $start to $destination\n";
	} 
	else {
		hanoi($n-1, $start, $destination, $helper);
		hanoi(1, $start, $helper, $destination);
		hanoi($n-1, $helper, $start, $destination);
	}
}

print '<pre>';
hanoi(4, "A", "B", "C");
print '</pre>';