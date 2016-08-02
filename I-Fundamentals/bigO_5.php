<?php

/**
 * Determine the memory complexity of counting the occurrences
 * of letters in a book.
 */

function getOcurrencesLetters($book) {
  $count = array();
  $strlen = strlen($book); // O(1)
  for ($i = 0; $i <= $strlen; $i++) {
    $char = substr($book, $i, 1);
    if ($char) {
      if (!isset($count[$char])) {
        $count[$char] = 0;
      }
      $count[$char] += 1;
    }
  }
  return $count;
}

/*
Memory (extra)
The keys of the count array would be the same for every book (if the same language)
O(~50 = english alphabet + symbols.) = O(1) -> independent of the book
 * A lot of occurrences in a letter (a big big big number) would break the memory.
 */

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$book = 'the string of the book';
$expected = array(
  't' => 3,
  'h' => 2,
  'e' => 2,
  ' ' => 4,
  's' => 1,
  'r' => 1,
  'i' => 1,
  'n' => 1,
  'g' => 1,
  'o' => 3,
  'f' => 1,
  'b' => 1,
  'k' => 1,
);

$result = getOcurrencesLetters($book);
assert(
  $result === $expected,
  'Expected ' . json_encode($expected) . ' got ' . json_encode($result)
);

print "Test passed. getOcurrencesLetters function works\n";
