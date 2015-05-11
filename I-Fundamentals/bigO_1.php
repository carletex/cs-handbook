<?php

/**
 * Determine the runtime and memory complexities of finding
 * the average of an integer array.
 */
function average(array $numbers) {
  $len = 0; // O(1)
  $sum = 0; // O(1)
  foreach ($numbers as $number) { // O(n)
    $sum += $number; // O(1)
    // We don't use count() to control
    // what is really affecting.
    $len++; // O(1)
  }
  return $sum / $len; // O(1)
}

// Runtime: O(2 + n*2 + 1) = O(n)
// Memory (extra): O(2) = O(1)

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array(1,2,3,4,5), 'expected' => 3),
  array('input' => array(0,1,0,3), 'expected' => 1),
);

foreach ($tests as $test) {
  $result = average($test['input']);
  assert(
    $result === $test['expected'],
    implode($test['input'], ',') . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. Average function works\n";
