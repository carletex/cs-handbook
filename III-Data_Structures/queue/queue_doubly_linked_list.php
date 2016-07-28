<?php 

class Link {
	public $value;
	public $prev;
	public $next;

	public function __construct($value) {
		$this->value = $value;
		$this->prev = NULL;
		$this->next = NULL;
	}

	public function __toString() {
		return (string)$this->value;
	}
}

class DoublyLinkedList {
	public $head;
	public $end;
	public $size;

	public function _construct() {
		$this->head = null;
		$this->end = null;
		$this->size = 0;
	}

	public function push($value) {
		$newLink = new Link($value);
		if ($this->size == 0) {
			$this->head = $newLink;
			$this->end = $newLink;
		}
		else {
			$this->end->next = $newLink;
			$newLink->prev = $this->end;
			$this->end = $newLink;
		}
		$this->size++;
	}

	public function pop() {
		if ($this->head == null) {
			throw new Exception('Empty Linked list');
		}
		$ret = $this->head;
		$this->head = $this->head->next;
		$this->head->prev = NULL;
		$this->size--;
		if ($this->size == 0) {
			$this->end = null;
		}
		return $ret;
	}

	public function get($index) {
		if ($this->size / 2 >= $index) {
			$i = 0;
			$current = $this->head;
			while ($current != NULL) {
				if ($index == $i){
					return $current;
				}
				$current = $current->next;
				$i++;
			}
		}
		else {
			$i = $this->size - 1;
			$current = $this->end;
			while ($current != NULL) {
				if ($index == $i){
					return $current;
				}
				$current = $current->prev;
				$i--;
			}
		}
		throw new Exception('Invalid index');
	}

	public function deleteNext(Link $node) {
		if ($node->next == $this->end) {
			$this->end = $node;
		}
		$node->next = $node->next->next;
		$this->size--;
		if ($this->end != $node) {
			$node->next->prev = $node;
		}
	}

	public function __toString() {
		for ($i = 0; $i < $this->size; $i++) { 
			$ret[] = $this->get($i);
		}
		return implode($ret, ',');
	}

}
