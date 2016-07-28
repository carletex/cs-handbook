<?php 

/**
 * MaxHeap Implementation
 */
class MaxHeap {

  public $arr;
  public $size;

  public function __construct($startSize) {
    $this->arr = new SplFixedArray($startSize);
    $this->size = 0;
  }

  public function resize() {
    $newArr = new SplFixedArray(count($this->arr) * 2);
    for ($i = 0; $i < $this->size; $i++) {
      $newArr[$i] = $this->arr[$i];
    }
    $this->arr = $newArr;
  }

  public function swap($a, $b) {
    $tmp = $this->arr[$a];
    $this->arr[$a] = $this->arr[$b];
    $this->arr[$b] = $tmp;
  }

  public function push($x) {
    if ($this->size >= count($this->arr)) {
      $this->resize();
    }
    // Insert to the end of the heap.
    $this->arr[$this->size] = $x;
    $this->size++;
    $idx = $this->size - 1;
    $parent = ($idx - 1) / 2;
    // Push the node up until the parent is larger.
    while ($idx > 0 && $this->arr[$parent] < $this->arr[$idx]) {
      $this->swap($parent, $idx);
      $idx = $parent;
      $parent = ($idx - 1) / 2;
    }
  }

  public function bubbleDown($idx) {
    while ($idx < $this->size) {
      $left = $idx * 2 + 1;
      $right = $idx * 2 + 2;
      if ($left < $this->size && $right < $this->size) {
        // If both child exists.
        if ($this->arr[$left] > $this->arr[$right] && 
          // If left child is larger than right child and
          // current node.
          $this->arr[$left] > $this->arr[$idx]) {
          $this->swap($left, $idx);
          $idx = $left;
        }
        elseif ($this->arr[$right] >= $this->arr[$left] &&
          $this->arr[$right] > $this->arr[$idx]) {
          // If right child is larger or equal than left child
          // and current node.
          $this->swap($right, $idx);
          $idx = $right;
        }
        else {
        // If no children, stop.
          break;
        }
      }
      elseif ($left < $this->size) {
        // If there is only a left child.
        $this->swap($left, $idx);
        $idx = $left;
      }
      // If there is only a right child.
      elseif ($right < $this->size) {
        $this->swap($right, $idx);
        $idx = $right;
      }
      else {
        break;
      }
    }
  }

  public function pop() {
    if ($this->size == 0) {
      return 0;
    }
    // Swap root and last element of heap.
    $ret = $this->arr[0];
    $this->arr[0] = $this->arr[$this->size - 1];
    $this->size--;
    // Push the root down until parent is greater than
    // children
    $this->bubbleDown(0);
    return $ret;
  }

  public function heapify(SplFixedArray $arr, $size) {
    $this->arr = $arr;
    $this->size = $size;
    // Reach height of tree.
    for ($i = 0; $i < floor(count($this->arr) / 2.0); $i++) {
      // Iterate through array.
      $this->bubbleDown($i);
    }
  }
}
