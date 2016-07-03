<?php 

class Link {
	public $value;
	public $next;

	public function __construct($value) {
		$this->value = $value;
		$this->next = NULL;
	}
}

class LinkedList {
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
		$this->size--;
		if ($this->size == 0) {
			$this->end = null;
		}
		return $ret;
	}

	public function get($index) {
		$i = 0;
		$current = $this->head;
		while ($current != NULL) {
			if ($index == $i){
				return $current;
			}
			$current = $current->next;

			$i++;
		}
		throw new Exception('Invalid index');
	}

	public function deleteNext(Link $node) {
		if ($node->next == $this->end) {
			$this->end = $node;
		}
		$node->next = $node->next->next;
		$this->size--;
	}

}
