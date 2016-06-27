<?php 

/**
 * Write the formalization and code for a recursive insertAll(ch, stringArr).
 */

/*
	Formalization:
	Let insertAll(ch, stringArr) be a function that inserts
	the character ch in every position in every string
	stringArr.

	Base case:
	insertAll(ch, '') = ''

	Recurrence:
	insertAll(ch, str) = ch + insertAll(ch, str[1..N])

*/

// Helper. Inserts $c in every position of $str
function insertStr($c, $str) {

}

function insertAll($c, $strArr) {
	if (empty($strArr)) {
		return array();
	}
	else {
		$result = array_merge(insertStr($c, $strArr[0]), insertAll($c, array_shift($stringArr)));
		return $result;
	}
}

assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array('x', array('ab', 'ba')), 'expected' => array('xab','axb','abx', 'xba', 'bxa', 'bax')),
);

foreach ($tests as $test) {
  $result = insertAll($test['input'][0], $test['input'][1]);
  print_r($result);
  // Sort
  sort($test['expected']);
  sort($result);
  assert(
    $result === $test['expected'],
    'Expected ' . implode($test['expected'], ',') . ' got ' . implode($result, ',')
  );
}

print "All test passed. insertAll function works\n";