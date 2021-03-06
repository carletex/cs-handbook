<?php
/**
 * Given an array of N integers, write a recursive function to
 * get the sum
 */
function arraySum(array $numbers) {
  return $numbers ? arraySum(array_slice($numbers, 1)) + $numbers[0] : 0;
}

// Formalization
// Base: arraySum(array()) = 0
// Recurrence: arraySum(n) = n[0] + arraySum(n[1..n])

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array(2, 1, 5, 6, 8), 'expected' => 22),
  array('input' => array(0, 1, 0, 3), 'expected' => 4),
  array('input' => array(2, 0, -5, -1), 'expected' => -4),
);

foreach ($tests as $test) {
  $result = arraySum($test['input']);
  assert(
    $result === $test['expected'],
    implode($test['input'], ',') . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. Array Sum works\n";
