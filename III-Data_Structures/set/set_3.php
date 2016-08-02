<?php

/**
 * 3. Given an array of numbers, find the number of pairs of
 * numbers that sum to 0.
 */

function getNumberPairsZero($numbers) {
  if (!$numbers) {
    return 0;
  }
  $pairs = 0;
  $firstNumber = array_shift($numbers);
  foreach ($numbers as $number) {
    if ($firstNumber + $number == 0) {
      $pairs++;
    }
  }
  return $pairs + getNumberPairsZero($numbers);
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array(
    'input' => array('8', '2', '4', '-8', '-2'),
    'expected' => 2,
  ),
  array(
    'input' => array('2', '-1', '9', '-12', '5'),
    'expected' => 0,
  ),
  array(
    'input' => array('9', '8', '2', '-8', '-2', '-9'),
    'expected' => 3,
  ),
);

foreach ($tests as $test) {
  $result = getNumberPairsZero($test['input']);
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. getNumberPairsZero works\n";
