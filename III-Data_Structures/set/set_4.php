<?php

/**
 * Given an array of numbers, find the number of tuples of size
 * 4 that add to 0.
 * • For example in the list (10,5,-1, 3, 4, -6) the tuple of
 *   size 4 (-1,3,4-6) adds to 0.
 */

define("K", 4);

function getArraySubsets($numbers, &$subsets, $used = array(), $index = 0, $currentSize = 0) {

  $len = sizeof($numbers);
  if ($currentSize == K) {
    $subset = array();
    for ($i = 0; $i < $len; $i++) {
      if (isset($used[$i]) && $used[$i]) {
        array_push($subset, $numbers[$i]);
      }
    }
    array_push($subsets, $subset);
    return;
  }
  if ($index >= $len) {
    return;
  }
  $used[$index] = true;

  $index_call = $index + 1;
  $currentSize_call = $currentSize + 1;
  getArraySubsets($numbers, $subsets, $used, $index_call, $currentSize_call);

  $used[$index] = false;
  getArraySubsets($numbers, $subsets, $used, ++$index, $currentSize);

}

function getTuplesAddsZero($numbers) {
  $subsets = array();
  getArraySubsets($numbers, $subsets);
  $tuples = 0;
  foreach ($subsets as $subset) {
    if (array_sum($subset) == 0) {
      $tuples++;
    }
  }
  return $tuples;
}

/**
 * Tests
 */
// assert_options(ASSERT_BAIL, 1);

$tests = array(
  array(
    'input' => array(10, 5, -1, 3, 4, -6),
    'expected' => 1,
  ),
  array(
    'input' => array(4, 5, 6, 8),
    'expected' => 0,
  ),
  array(
    'input' => array(-2, 2, 1, -1, 8, -8),
    'expected' => 3,
  ),
);

foreach ($tests as $test) {
  $result = getTuplesAddsZero($test['input']);
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. getTuplesAddsZero works\n";
