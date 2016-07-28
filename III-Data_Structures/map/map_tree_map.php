<?php

/**
 * Implementation of a Tree map as binary search tree
 */

class Pair {
    public $key;
    public $value;
    
    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }
}

class Node {
  public $value;
  public $left;
  public $right;
  public $parent; // Not needed

  public function __construct($key, $val, Node $parent = NULL){
    $this->value = new Pair($key, $val);
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

class TreeMap {
  public $size;
  public $root;

  public function __construct(){
    $this->size = 0;
    $this->root = null;
  }

  public function insert($key, $val) {
    // If empty BST.
    if (!$this->root) {
      $this->root = new Node($key, $val);
      $this->size = 1;
      return TRUE;
    }

    $curNode = $this->root;
    while ($curNode) {
      if ($key == $curNode->value->key) {
        // Return if key already exists in set.
        return FALSE;
      }
      elseif ($key < $curNode->value->key) {
        // Traverse left if key is less than current node.
        // If left child is empty, create new node.
        if (!$curNode->left) {
          $curNode->left = new Node($key, $val, $curNode);
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
          $curNode->right = new Node($key, $val, $curNode);
          $this->size++;
          return TRUE;
        }
        // Traverse right child.
        $curNode = $curNode->right;
      }
    }
    return FALSE;
  }

  public function contains($key) {
    $curNode = $this->root;
    // Iterate through tree.
    while ($curNode != null) {
      if ($key == $curNode->value->key) {
        return TRUE;
      }
      elseif ($key < $curNode->value->key) {
        // Traverse left tree if key is less than current node.
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

  public function getValue($key) {
    $curNode = $this->root;
    // Iterate through tree.
    while ($curNode != null) {
      if ($key == $curNode->value->key) {
        return $curNode->value->value;
      }
      elseif ($key < $curNode->value->key) {
        // Traverse left tree if key is less than current node.
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

  public function changeValue($key, $newVal) {
    $curNode = $this->root;
    // Iterate through tree.
    while ($curNode != null) {
      if ($key == $curNode->value->key) {
        // Chnage the value
        $curNode->value->value = $newVal;
        return $newVal;
      }
      elseif ($key < $curNode->value->key) {
        // Traverse left tree if key is less than current node.
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


  public function remove($key) {
    $curNode = $this->root;
    while ($curNode) {
      if ($key == $curNode->value->key) {
        break;
      }
      elseif ($key < $curNode->value->key) {
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
      $ret .= $curTree->value->key . '=>' . $curTree->value->value;
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
