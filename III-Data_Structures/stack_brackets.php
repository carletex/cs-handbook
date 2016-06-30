<?php 
/*

1. Given a string of brackets of either () or [], determine if the
bracket syntax is legal (every opening bracket has a closing
bracket from left to right).
	Legal syntax:
	• ([()[]])
	• ()()[]()()
	Illegal syntax:
	• (()]
	• ()[(])

*/

function checkBrackets($str) {

}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => '([()[]])', 'expected' => TRUE),
  array('input' => '()()[]()()', 'expected' => TRUE),
  array('input' => '(()]', 'expected' => FALSE),
  array('input' => '()[(])', 'expected' => FALSE),
);

foreach ($tests as $test) {
  $result = checkBrackets($test['input'][0]);
  assert(
    $result === $test['expected'],
    'Expected ' . implode($test['expected'], ',') . ' got ' . implode($result, ',')
  );
}

print "All test passed. checkBrackets function works\n";