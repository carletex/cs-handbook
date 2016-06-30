<?php 

class Vector {
	public $int_arr;
	public $size = 0;
	
	public function __construct($size) {
		// Simulate "array allocation" in php
		$this->int_arr = array_fill(0, $size, NULL);
	}

	public function resize() {
		$newArr = array_fill(0, 2 * count($this->int_arr), NULL);
		// Copy to new array.
		for ($i = 0; $i < $this->size; $i++) {
			$newArr[$i] = $this->int_arr[$i];
		}
		$this->int_arr = $newArr;
	}

	public function add($el) {
		if ($this->size >= count($this->int_arr)) {
			$this->resize();
		}
		$this->int_arr[$this->size] = $el;
		$this->size++;
	}

	public function pop() {
		if ($this->size == 0) {
			throw new Exception('Empty vector');
		}
		$el = $this->int_arr[$this->size - 1];
		$this->int_arr[$this->size - 1] = null;
		$this->size--;
		return $el;
	}

	public function remove($index) {
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Invalid index');
		}
		$el = $this->int_arr[$index];
		while ($index + 1 < $this->size) {
			$this->int_arr[$index] = $this->int_arr[$index + 1];
			$index++;
		}
		$this->int_arr[$this->size - 1] = null;
		$this->size--;
		return $el;
	}


	public function get($index) {
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Invalid index');
		}
		return $this->int_arr[$index];
	}

	public function insert($index, $el) {
		if ($index < 0 || $index >= $this->size) {
			throw new Exception('Invalid index');
		}
		$this->size++;
		if ($this->size >= count($this->int_arr)) {
			resize();
		}
		$index2 = $this->size;
		// Shift elements to the right.
		while ($index2 > $index) {
			$this->int_arr[$index2 - 1] = $this->int_arr[$index2 - 2];
			$index2--;
		}
		// Insert element.
		$this->int_arr[$index] = $el;
	}

	/**
	 * 1. Implement addVector(Vector v) to the Vector class, which adds
	 * all the elements of v to the current vector. 
	 */
	public function addVector(Vector $vector) {
		for ($i = 0; $i < $vector->size; $i++) {
			$this->add($vector->get($i));
		}
	}

}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

print '<pre>';
// addVector
$vec = new Vector(4);
$vec->add(2);
$vec->add(24);

$vec2 = new Vector(2);
$vec2->add(1);
$vec2->add(32);

$expected = new Vector(4);
$expected->add(2);
$expected->add(24);
$expected->add(1);
$expected->add(32);

$vec->addVector($vec2);
assert(
	$vec == $expected,
	'Expected ' . json_encode($expected) . ' got ' . json_encode($vec)
);

print "Test passed. addVector method in Vector class works\n";
print '</pre>';

