<?php

/**
 * 4. Given a node in a doubly linked list, write a function that
 * removes the node from the list.
 */

include_once './queue_doubly_linked_list.php';

function removeNode(DoublyLinkedList $list, Link $node) {
  $current = $list->head;
  while ($current != NULL) {
    if ($current->next == $node) {
      $list->deleteNext($current);
      return $list;
    }
    $current = $current->next;
  }
  throw new Exception('Node not found');
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  // Input: 0: Array for creating the DoublyLinkedList. 1: Index to remove (to get the node)
  array('input' => array(array(10, 15, 28, 95), 2), 'expected' => '10,15,95'),
  array('input' => array(array(27, 5, 9, 12, 25, 10, 3), 6), 'expected' => '27,5,9,12,25,10'),
);

foreach ($tests as $test) {
  $list = new DoublyLinkedList();
  foreach ($test['input'][0] as $value) {
    $list->push($value);
  }
  $node = $list->get($test['input'][1]);
  $result = removeNode($list, $node);
  assert(
    $result == $test['expected'],
    json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
  );
}

print "All test passed. checkTails works\n";
