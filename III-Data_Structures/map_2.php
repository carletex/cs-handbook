<?php 
/** 
 * 2. Given a mapping of ids to names, output the ids in order
 * by lexicographical name.
 */

include_once './map_tree_map.php';

// Helper functions
function getSubtreeKeys(Node $curTree = NULL) {
  if (!$curTree) {
    return array();
  }
  $ret = array();
  // Print left child.
  $ret = array_merge($ret, getSubtreeKeys($curTree->left));
  // Print current node.
  array_push($ret, $curTree->value->key);
  // Print right child.
  $ret = array_merge($ret, getSubtreeKeys($curTree->right));
  return $ret;
}

function getAllKeys(TreeMap $tree) {
  $ret = array();
  if ($tree->root) {
    $ret = array_merge($ret, getSubtreeKeys($tree->root));
  }
  return $ret;
}

// Main function
function orderIDs($maps) {
  $tree = new TreeMap();
  foreach ($maps as $id => $value) {
    $tree->insert($id, $value);
  }
  return getAllKeys($tree);
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array(
    'input' => array('es-car' => 'Carlos', 'al-ann' => 'Anne' , 'de-pet' => 'Peter'),
    'expected' => array('al-ann', 'de-pet', 'es-car')
  ),
);

foreach ($tests as $test) {
  $result = orderIDs($test['input']);
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . json_encode($test['expected']) . ' got ' . json_encode($result)
  );
}

print "All test passed. orderIDs works\n";