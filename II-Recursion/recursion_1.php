<?php
/**
 * Given an array of N integers, write a recursive function to
 * get the sum
 *
 */
function arraySum (array $numbers) {
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
  22 => array(2,1,5,6,8),
  4 => array(0,1,0,3),
  -4 => array(2,0,-5,-1),
);

foreach ($tests as $expected => $testArray) {
  $result = arraySum($testArray);
  assert(
    $result == $expected,
    implode($testArray, ',') . ' expected ' . $expected . ' got ' . $result
  );
}

print "All test passed. Array Sum works\n";
