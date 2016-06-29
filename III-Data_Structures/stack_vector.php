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

}
echo "<pre>";
$vec = new Vector(4);
print '<h3>Add elements</h3>';
$vec->add(1);
$vec->add(2);
$vec->add(3);
$vec->add(4);
$vec->add(5);
$vec->add(6);
print '<br/>';
print_r($vec->int_arr);
print('size: ' . $vec->size);
print '<br/>';


print '<h3>Pop</h3>';
print('Pop: ' . $vec->pop());
print '<br/>';
print_r($vec->int_arr);
print('size: ' . $vec->size);
print '<br/>';


print '<h3>Remove index 2</h3>';
print('Remove: ' . $vec->remove(2));
print '<br/>';
print_r($vec->int_arr);
print('size: ' . $vec->size);
print '<br/>';


print '<h3>Get index 1</h3>';
print('Get: ' . $vec->get(1));
print '<br/>';
print_r($vec->int_arr);
print('size: ' . $vec->size);
print '<br/>';


print '<h3>Insert 23 on index 2</h3>';
print('Insert: ' . $vec->insert(2, 23));
print '<br/>';
print_r($vec->int_arr);
print('size: ' . $vec->size);
echo "</pre>";
