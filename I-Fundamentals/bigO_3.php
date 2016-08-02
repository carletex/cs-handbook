<?php

/**
 * Determine the runtime complexity of guessing a
 * N digit numeric password.
 */
function guessPassword($password) {
  $guess = 0;

  // This would break for big numbers.
  $intPass = intval($password);
  while (TRUE) {
    // Forever
    if ($guess === $intPass) {
      return $guess;
    }
    $guess++;
  }
  // Program would never reach this point
  return FALSE;
}

// Runtime: 0(n)
// The alternative is using a algorithm that uses strings

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$password = '1234';

$result = guessPassword($password);
assert(
  strval($result) === $password,
  'Expected ' . $password . ' got ' . strval($result)
);

print "Test passed. guessPassword function works\n";
