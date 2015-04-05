<?php
/**
 * Given a string S, write a recursive function to determine if
 * it is a palindrome.
 *
 */
function isPalindrome($s) {
  $len = strlen($s);
  if ($len == 0 || $len == 1) {
    return TRUE;
  }
  if ($s[0] == $s[$len - 1]) {
    return isPalindrome(substr($s, 1, $len - 2));
  }
  return FALSE;
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('data' => 'ana', 'expected' => TRUE),
  array('data' => 'radaar', 'expected' => FALSE),
  array('data' => 'neveroddoreven', 'expected' => TRUE),
);

foreach ($tests as $test) {
  $result = isPalindrome($test['data']);
  assert(
    $result === $test['expected'],
    $test['data'] . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. isPalindrome works\n";