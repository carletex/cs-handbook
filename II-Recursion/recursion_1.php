<?php
/**
 * Given an array of N integers, write a recursive function to
 * get the sum
 *
 */
function arraySum(array $numbers) {
  if (empty($numbers)) {
    return 0;
  }
  return arraySum(array_slice($numbers, 1)) + $numbers[0];
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('data' => array(2,1,5,6,8), 'expected' => 22),
  array('data' => array(0,1,0,3), 'expected' => 4),
  array('data' => array(2,0,-5,-1), 'expected' => -4),
);

foreach ($tests as $test) {
  $result = arraySum($test['data']);
  assert(
    $result === $test['expected'],
    implode($test['data'], ',') . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. Array Sum works\n";
