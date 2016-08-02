<?php

/**
 * 2. Write a function that checks if an array is a heap.
 */

// MAX HEAP
function checkIfMaxHeap($numbers) {
  $heap_size = sizeof($numbers);
  $idx = 0;

  do {
    $left = $idx * 2 + 1;
    $right = $idx * 2 + 2;
    if ($left < $heap_size && $right < $heap_size) {
      // Both child exists
      if (($numbers[$left] >= $numbers[$idx]) || ($numbers[$right] >= $numbers[$idx])) {
        return FALSE;
      }
      $idx++;
    } elseif ($left < $heap_size) {
      return $left < $numbers[$idx];
    } elseif ($right < $heap_size) {
      return $right < $numbers[$idx];
    } else {
      // No childs
      return TRUE;
    }
  } while (TRUE);
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array(10, 5, 7, 2, 3, 1, 6), 'expected' => TRUE),
  array('input' => array(10, 5, 7, 2, 8, 1, 6), 'expected' => FALSE),
);

foreach ($tests as $test) {
  $result = checkIfMaxHeap($test['input']);
  assert(
    $result == $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. checkIfMaxHeap works\n";
