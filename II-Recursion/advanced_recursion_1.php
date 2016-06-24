<?php 

/**
 * Given a string S, write a recursive function to generate all
 * its non-empty substrings.
 */

// Helper
// Return all the substrings from the string given, which have the first char of the string
function substring_toend($str) {
	// Base case on empty string
	if (empty($str)) { 
		return array();
	}
	// Recursive relation
	$result = array_merge(array($str), substring_toend(substr($str, 0, -1)));
	return $result;
}

function substring($str) {
	// Base case on empty string
	if (empty($str)) {
		return array();
	}
	// Recursive relation
	$result = array_merge(substring_toend($str), substring(substr($str, 1)));
	return $result;
}


/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => 'abc', 'expected' => array('a','ab','abc','b','bc','c')),
);

foreach ($tests as $test) {
  $result = substring($test['input']);
  // Sort
  sort($test['expected']);
  sort($result);
  assert(
    $result === $test['expected'],
    $test['input']. ' expected ' . implode($test['expected'], ',') . ' got ' . implode($result, ',')
  );
}

print "All test passed. substring function works\n";