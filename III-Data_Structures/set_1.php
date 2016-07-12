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
	// ToDo. We need a tree where duplicate are allowed
	$tree = new BinarySearchTree();
	$w1arr = str_split($w1);
	$w2arr = str_split($w2);

	// Populate tree
	foreach ($w1arr as $c) {
		$tree->insert($c);
	}

	// Remove w2 chars
	foreach ($w2arr as $c) {
		if (!$tree->size) {
			// We emptied the tree.
			// W2 has the same chars than W1 and more.
			return 0;
		}
		$tree->remove($c);
	}

	if (!$tree->size) {
		// Empty tree
		// W1 and W2 have the same chars
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
	return $pairs +	getNumberPairsAnagrams($words);
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