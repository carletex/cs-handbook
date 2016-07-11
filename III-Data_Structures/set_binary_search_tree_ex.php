<?php 

/**
 * 1. Write a function to determine if a binary tree is a binary
 * search tree.
 */

include_once './set_binary_search_tree.php';

/**
 * Checks if a given node meets the binary search tree requirements
 * node < right && node > left
 */
function isSearchNode(Node $node = NULL) {
	if (!$node) {
		return TRUE;
	}
	$value = $node->value;
	$leftValue = isset($node->left) ? $node->left->value : NULL;
	$rightValue = isset($node->right) ? $node->right->value : NULL;

	if (((isset($leftValue) && $value > $leftValue) || !$leftValue) ||
		((isset($rightValue) && $value < $rightValue) || !$rightValue)) {
			return TRUE;
	}
	return FALSE;
}

function isSearchSubTree(Node $curTree = NULL) {
	if (!$curTree) {
		return TRUE;
	}
	// Recurrence
	return isSearchNode($curTree) && isSearchSubTree($curTree->left) && isSearchSubTree($curTree->right);
}

function isSearchTree(BinarySearchTree $binaryTree = NULL) {
	$ret = FALSE;
	if ($binaryTree->root) {
		$ret = isSearchSubTree($binaryTree->root);
	}
	return $ret;
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

$binaryTree = new BinarySearchTree();
$binaryTree->insert(7);
$binaryTree->insert(2);
$binaryTree->insert(8);
$binaryTree->insert(9);
$binaryTree->insert(1);
$binaryTree->insert(4);
// Make it non-search
$binaryTree->root->left->value = 99;

$binaryTree = new BinarySearchTree();

$tests = array(
  array('input' => $binarySearchTree, 'expected' => TRUE),
  array('input' => $binaryTree, 'expected' => FALSE),
);

foreach ($tests as $test) {
	$result = isSearchTree($test['input']);
	assert(
		$result === $test['expected'],
		json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
	);
}

print "All test passed. isSearhTree works\n";