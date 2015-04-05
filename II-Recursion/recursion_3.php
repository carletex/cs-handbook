<?php
/**
 * Given a number N, write a recursive function to output the
 * number in binary.
 *
 */
function getBinary($n) {
  if ($n == 0) {
    return '';
  }
  return getBinary(intval($n / 2)) . $n % 2;
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('data' => 1, 'expected' => '1'),
  array('data' => 25, 'expected' => '11001'),
  array('data' => 137, 'expected' => '10001001'),
);

foreach ($tests as $test) {
  $result = getBinary($test['data']);
  assert(
    $result === $test['expected'],
    $test['data'] . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. getBinary works\n";
