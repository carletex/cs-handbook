<?php 

/**
 * Determine the runtime complexity of summing the digits of
 * a number.
 */

function sumDigits($number) {
	$sum = 0; // O(1)
	do {
		$sum += $number % 10; // O(1)
	} while ($number = (int) $number / 10); // O(log n)
	return $sum;
}

// Runtime: O(log n + 1 + 1) = O(log n)

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$number = 1234;
$expected = 10;

$result = sumDigits($number);
assert(
	$result === $expected,
	'Expected ' . $expected . ' got ' . $result
);

print "Test passed. sumDigits function works\n";
