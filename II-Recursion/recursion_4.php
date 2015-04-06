<?php
/**
 * Given a string S, write a recursive function to return a
 * reversed string
 */
function reverse($s) {
  return $s ? reverse(substr($s, 1)) . $s[0] : '';
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => 'laptop', 'expected' => 'potpal'),
  array('input' => 'Carlos1985', 'expected' => '5891solraC'),
  array('input' => '_Cool#Pass!word', 'expected' => 'drow!ssaP#looC_'),
);

foreach ($tests as $test) {
  $result = reverse($test['input']);
  assert(
    $result === $test['expected'],
    $test['input'] . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. reverse works\n";
