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

$bracketPairs = array(
  '(' => ')',
  '[' => ']',
);

/**
 * Check if $c1 and $c2 are bracket pairs
 */
function isBracketClosingPair($c1, $c2) {
  global $bracketPairs;
  return isset($bracketPairs[$c1]) && $bracketPairs[$c1] == $c2;
}

function checkBrackets($str) {
  $str_arr = str_split($str);
  // We are using a array as a stack
  $stack = array();
  foreach ($str_arr as $c) {
    $count = sizeof($stack);
    if (isset($stack[$count - 1]) && isBracketClosingPair($stack[$count - 1], $c)) {
      // Match: remove element
      array_pop($stack);
    } else {
      array_push($stack, $c);
    }
  }
  // If the stack isn't empty: invalid bracket string
  if (!empty($stack)) {
    return FALSE;
  }
  return TRUE;
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
  $result = checkBrackets($test['input']);
  assert(
    $result === $test['expected'],
    'Expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. checkBrackets function works\n";
