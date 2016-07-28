<?php

/**
 * Implementation of a binary search tree
 */

class Node {
	public $value;
	public $left;
	public $right;
	public $parent; // Not needed

	public function __construct($val, Node $parent = NULL){
		$this->value = $val;
		$this->left = null;
		$this->right = null;
		$this->parent = $parent;
	}

	public function replaceChild(Node $child, Node $replacement = NULL) {
		if ($this->left == $child) {
			$this->left = $replacement;
		}
		elseif ($this->right == $child) {
			$this->right = $replacement;
		}
		// Set replacement nodes parent.
		if ($replacement) {
			$replacement->parent = $this;
		}
	}

}

class BinarySearchTree {
	public $size;
	public $root;

	public function __construct(){
		$this->size = 0;
		$this->root = null;
	}

	public function insert($x) {
		// If empty BST.
		if (!$this->root) {
			$this->root = new Node($x);
			$this->size = 1;
			return TRUE;
		}

		$curNode = $this->root;
		while ($curNode) {
			if ($x == $curNode->value) {
				// Return if x already exists in set.
				return FALSE;
			}
			elseif ($x < $curNode->value) {
				// Traverse left if x is less than current node.
				// If left child is empty, create new node.
				if (!$curNode->left) {
					$curNode->left = new Node($x, $curNode);
					$this->size++;
					return TRUE;
				}
				// Traverse left child.
				$curNode = $curNode->left;
			}
			else {
				// Traverse right otherwise.
				// If right child is empty, create new node.
				if (!$curNode->right) {
					$curNode->right = new Node($x, $curNode);
					$this->size++;
					return TRUE;
				}
				// Traverse right child.
				$curNode = $curNode->right;
			}
		}
		return FALSE;
	}

	public function contains($x) {
		$curNode = $this->root;
		// Iterate through tree.
		while ($curNode != null) {
			if ($x == $curNode->value) {
				return TRUE;
			}
			elseif ($x < $curNode->value) {
				// Traverse left tree if x is less than current node.
				$curNode = $curNode->left;
			}
			else {
				// Traverse right tree if x is greater then current node
				$curNode = $curNode->right;
			}
		}
		// Return false if not found.
		return FALSE;
	}

	public function remove($x) {
		$curNode = $this->root;
		while ($curNode) {
			if ($x == $curNode->value) {
				break;
			}
			elseif ($x < $curNode->value) {
				// Traverse through left child.
				$curNode = $curNode->left;
			}
			else {
				// Traverse through right child.
				$curNode = $curNode->right;
			}
		}
		// If node was not found, return false.
		if (!$curNode) {
			return FALSE;
		}

		// Case 1: Removed node has no children.
		if (!$curNode->left && !$curNode->right) {
			// Special case if root.
			if ($curNode == $this->root) {
				$this->root = NULL;
			}
			// Replace node with null.
			else {
				$curNode->parent->replaceChild($curNode, NULL);
			}
		}
		else if (!$curNode->left) {
			// Case 2a: Removed node only has a right child.
			// Special case if node is root.
			if ($curNode == $this->root) {
				$this->root = $curNode->right;
				$this->root->parent = NULL;
			}
			// Replace current node with right child.
			else {
				$curNode->parent->replaceChild($curNode, $curNode->right);
			}
		}
		elseif (!$curNode->right) {
			// Case 2b: Removed node only has a left child.
			// Special case if node is root.
			if ($curNode == $this->root) {
				$this->root = $curNode->left;
				$this->root->parent = NULL;
			}
			// Replace current node with left child.
			else {
				$curNode->parent->replaceChild($curNode, $curNode->left);
			}
		}
		else {
			// Case 3: Removed node has two children.
			// Get rightmost of left subtree.
			$rightmost = $curNode->left;
			while ($rightmost->right) {
				$rightmost = $rightmost->right;
			}
			// Copy rightmost of left subtree to removed node’s.
			$curNode->value = $rightmost->value;
			// Replace rightmost of left subtree with left child.
			$rightmost->parent->replaceChild($rightmost, $rightmost->left);
			}
			$this->size--;
			return TRUE;
		}

		public function strSubtree(Node $curTree = NULL) {
			if (!$curTree) {
				return "";
			}
			$ret = "";
			// Print left child.
			$ret .= $this->strSubtree($curTree->left);
			// Print current node.
			$ret .= $curTree->value;
			$ret .= ",";
			// Print right child.
			$ret .= $this->strSubtree($curTree->right);
			return $ret;
		}

		public function __toString() {
			$ret = "";
			if ($this->root) {
				$ret .= $this->strSubtree($this->root);
			}
			// return ret.substring(0, ret.length() - 1);
			return rtrim($ret, ',');
		}

}
