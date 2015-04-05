<?php
/*
 * Given an array of N integers, write a recursive function to
 * get the sum
 *
 */
assert_options(ASSERT_BAIL, 1);

$testArray = array(2,1,5,6,8);
$testArray1 = array(0,1,0,3);
$testArray2 = array(2,0,5,-1);

function arraySum (array $numbers) {
  if (empty($numbers)) {
    return 0;
  }
  return arraySum(array_slice($numbers, 1)) + $numbers[0];
}

assert(arraySum($testArray) == 22, "Array sum for testArray");
assert(arraySum($testArray1) == 4, "Array sum for testArray1");
assert(arraySum($testArray2) == 6, "Array sum for testArray2");

print "Array Sum works\n";