<?php

/**
 * Determine the memory complexity of counting the occurrences
 * of words in a book.
 */

function getOcurrencesWords($book) {
  $count = array();
  $strlen = strlen($book); // O(1)
  $word = '';
  for ($i = 0; $i <= $strlen; $i++) {
    $char = substr($book, $i, 1);
    if ($char == ' ' || $char == FALSE) {
      if (!isset($count[$word])) {
        $count[$word] = 0;
      }
      $count[$word] += 1;
      $word = '';
    } else {
      $word .= $char;
    }
  }
  return $count;
}

/*
Memory (extra)
The keys of the count array would be the same for every book (if the same language)
O(words in the dictionary/grammar book) = O(1) -> independent of the book
 */

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$book = 'the string of the book';
$expected = array(
  'the' => 2,
  'string' => 1,
  'of' => 1,
  'book' => 1,
);

$result = getOcurrencesWords($book);
assert(
  $result === $expected,
  'Expected ' . json_encode($expected) . ' got ' . json_encode($result)
);

print "Test passed. getOcurrencesWords function works\n";
