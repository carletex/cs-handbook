<?php

/**
 * 1. Given a list of words, determine how many of them are
 * anagrams of each other. An anagram is a word that can
 * have its letters scrambled into another word.
 *  • For example, silent and listen are anagrams but banana
 *    and orange are not.
 */

include_once './set_binary_search_tree.php';

function checkAnagram($w1, $w2) {
  /**
   * If we want to implement this with a tree we need
   * a tree where duplicates are allowed, so:
   *   1- Add all the chars in w1 to the tree
   *   2- Remove all the char in w1 in the tree
   *   3- Result
   *     * If tree is empty at the end of the loop => anagram
   *     * If we a empty the tree before finishing the loop => not anagram.
   *     * Any other case => not anagram.
   *
   * For more See commit 7d7a11007e98864813c9bb6a635fe0c7682b635b
   */

  // We use arrays
  $w1arr = str_split($w1);
  $w2arr = str_split($w2);

  // Remove w2 chars
  if (sizeof($w1arr) == sizeof($w2arr) && !array_diff($w1arr, $w2arr)) {
    return 1;
  }

  return 0;
}

function getNumberPairsAnagrams($words) {
  if (!$words) {
    return 0;
  }
  $pairs = 0;
  $firstWord = array_shift($words);
  foreach ($words as $word) {
    $pairs += checkAnagram($firstWord, $word);
  }
  return $pairs + getNumberPairsAnagrams($words);
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array('silent', 'banana', 'orange', 'listen'), 'expected' => 1),
  array('input' => array('rat', 'vehicle', 'alcohol', 'sound'), 'expected' => 0),
  array('input' => array('monja', 'male', 'pool', 'jamon', 'lame', 'polo'), 'expected' => 3),
  array('input' => array('pool', 'polo', 'loop', 'lame'), 'expected' => 3),
);

foreach ($tests as $test) {
  $result = getNumberPairsAnagrams($test['input']);
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. getNumberPairsAnagrams works\n";
