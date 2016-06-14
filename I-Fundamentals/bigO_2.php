<?php

/**
 * Determine the runtime and memory complexities of adding
 * two NxN matrices together.
 */
function matrixSum(array $matrix1, array $matrix2) {
  $resultMatrix = array(); // 0(1)
  foreach ($matrix1 as $i => $row) { // O(n)
    foreach ($row as $j => $value) { // O(m)
      $resultMatrix[$i][$j] = $matrix1[$i][$j] + $matrix2[$i][$j]; // O(1)
    }
  }
  return $resultMatrix;
}

// Runtime: O(1 + n*m) = O(n^2)
// Memory (extra): O(n)

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$matrix1 = array(
    array(1, 2, 3),
    array(4, 5, 6),
);
$matrix2 = array(
    array(4, 5, 6),
    array(7, 8, 9),
);
$sumExpected = array(
    array(5, 7, 9),
    array(11, 13, 15),
);

$result = matrixSum($matrix1, $matrix2);
assert(
  $result === $sumExpected,
  json_encode($matrix1) . ' + ' . json_encode($matrix2)
  . ' expected ' . json_encode($sumExpected)
  . ' got ' . json_encode($result)
);

print "Test passed. MatrixSum function works\n";
