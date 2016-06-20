<?php
/**
 * Given a string S, write a recursive function to determine if
 * it is a palindrome.
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

// Formalization
// Base: isPalindrome(0) = TRUE, isPalindrome(1) = TRUE
// Recurrence: isPalindrome(s) = (s[0] == s[n]) && isPalindrome(s[1..n-1])

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => 'ana', 'expected' => TRUE),
  array('input' => 'radaar', 'expected' => FALSE),
  array('input' => 'neveroddoreven', 'expected' => TRUE),
);

foreach ($tests as $test) {
  $result = isPalindrome($test['input']);
  assert(
    $result === $test['expected'],
    $test['input'] . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. isPalindrome works\n";
