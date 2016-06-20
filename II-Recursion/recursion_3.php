<?php
/**
 * Given a number N, write a recursive function to output the
 * number in binary.
 */
function getBinary($n) {
  return $n ? getBinary(intval($n / 2)) . $n % 2 : '0';
}

// Formalization
// Base: getBinary(0) = '0';
// Recurrence: getBinary(n) = getBinary(n/2) . n % 2

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => 0, 'expected' => '0'),
  array('input' => 25, 'expected' => '011001'),
  array('input' => 137, 'expected' => '010001001'),
);

foreach ($tests as $test) {
  $result = getBinary($test['input']);
  assert(
    $result === $test['expected'],
    $test['input'] . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. getBinary works\n";
