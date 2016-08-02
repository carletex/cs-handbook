<?php
/**
 * 3. Given two linked lists which may share tails, determine the
 * point at which they converge. For example, if our first linked
 * list is [1,2,4,5] and our second linked list is [0,3,4,5] and each
 * number is a node, then the two linked lists converge at 4.
 */

include_once './queue_linked_list.php';

function checkTails(LinkedList $ll1, LinkedList $ll2) {
  // Assuming equal values (==) not equal objects (===)
  // O(n^2)
  for ($i = 0; $i < $ll1->size; $i++) {
    $el1 = $ll1->get($i);
    for ($j = 0; $j < $ll2->size; $j++) {
      $el2 = $ll2->get($j);
      if ($el1 == $el2) {
        // If these are equals means that the tail is equal
        // $el1->value == $el2->value and next() goes
        // until the end
        return $el1->value;
      }
    }
  }
  return FALSE;
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array(array(1, 2, 4, 5), array(0, 3, 4, 5)), 'expected' => 4),
  array('input' => array(array(1, 2, 4, 5), array(0, 7, 8, 9)), 'expected' => FALSE),
  array('input' => array(array(27, 4, 9, 10, 24, 12), array(10, 24, 12)), 'expected' => 10),
);

foreach ($tests as $test) {
  $ll1 = new LinkedList();
  foreach ($test['input'][0] as $value) {
    $ll1->push($value);
  }
  $ll2 = new LinkedList();
  foreach ($test['input'][1] as $value) {
    $ll2->push($value);
  }
  $result = checkTails($ll1, $ll2);
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. checkTails works\n";
