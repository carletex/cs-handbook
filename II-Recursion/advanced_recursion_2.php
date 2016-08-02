<?php

/**
 * Hanoi: Write a solution for hanoi towers but with the restriction
 * that discs can only be moved from adjacent poles. (You can
 * move a disc from A to B but not A to C because they are not adjacent).
 */

// We are asumming a 3-peg hanoi problem
function hanoi($n, $start, $destination) {
  if ($n > 0) {
    hanoi($n - 1, $start, $destination);
    print "Move from $start to B\n";
    hanoi($n - 1, $destination, $start);
    print "Move from B to $destination\n";
    hanoi($n - 1, $start, $destination);
  }
}

print '<pre>';
hanoi(3, "A", "C");
print '</pre>';
