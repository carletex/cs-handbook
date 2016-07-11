<?php 

/**
 * 1. Write a function to determine if a binary tree is a binary
 * search tree.
 */

include_once './set_binary_search_tree.php';

function isSearhTree($binaryTree) {

}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$binarySearchTree = new BinarySearchTree();

$binarySearchTree->insert(7);
$binarySearchTree->insert(2);
$binarySearchTree->insert(8);
$binarySearchTree->insert(9);
$binarySearchTree->insert(1);
$binarySearchTree->insert(4);

echo "<pre>";
print_r($binarySearchTree);
print($binarySearchTree);
echo "</pre>";

// $binaryTree = new BinarySearchTree();

// $tests = array(
//   array('input' => $binarySearchTree, 'expected' => TRUE),
//   // array('input' => $binaryTree, 'expected' => FALSE),
// );

// foreach ($tests as $test) {
// 	$result = isSearhTree($test['input']);
// 	assert(
// 		$result === $test['expected'],
// 		json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
// 	);
// }

// print "All test passed. isSearhTree works\n";