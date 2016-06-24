<?php 

/**
 * Given a string S, write a recursive function to generate all
 * its non-empty substrings.
 */

function substring($str) {

	if ($str) {
		$str_array = str_split($str);
		$len = count($str_array);
		$sub = '';
		$result = array();
		for ($i=0; $i < $len; $i++) { 
			$sub .= $str_array[$i];
			$result[] = $sub;
		}
		$result = array_merge($result, substring(substr($str, 1)));
		return $result;
	}
	return array();
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