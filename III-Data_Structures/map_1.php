<?php 

/**
 * 1. Given a list of N strings, output the strings in alphabetical
 * order and the number of times they appear in the list.
 */

include_once './map_tree_map.php';

function orderAndCount($strings) {
  $list = new TreeMap();
  foreach ($strings as $string) {
    if ($list->contains($string)) {
      $list->changeValue($string, $list->getValue($string) + 1);
    }
    else {
      $list->insert($string, 1);
    }
  }
  print $list;
  return $list;
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);


$tests = array(
  array('input' => array('abc', 'zyz', 'abc', 'asd'), 'expected' => 'abc=>2,asd=>1,zyz=>1'),
);

foreach ($tests as $test) {
  $result = orderAndCount($test['input']);
  ob_start();
  print $result;
  $result = ob_get_clean();
  assert(
    $result === $test['expected'],
    json_encode($test['input']) . ' expected ' . json_encode($test['expected']) . ' got ' . $result
  );
}

print "All test passed. orderAndCount works\n";
