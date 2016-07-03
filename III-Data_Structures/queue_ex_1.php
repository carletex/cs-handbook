<?php 
/**
 * 1. Given a list of letters representing instructions where the
 * first instruction is executed, output what the final list should
 * look like after N instructions are executed.
 * • A. Add B to the end of the list of instructions
 * • B. Do nothing
 * • C. Add two A’s to the front of the list of instructions
 */

include_once './queue_linked_list.php';


class InstructionsReader {
	public $list;
	public $steps;
	public $instructions = array(
		'A' => 'addBtoEnd',
		'B' => 'doNothing',
		'C' => 'add2AtoFront',
	);

	public function __construct($instructions_str, $steps) {
		$this->steps = $steps;
		$this->list = new LinkedList();
		$ins_array = str_split($instructions_str);
		foreach ($ins_array as $ins) {
			$this->list->push($ins);
		}
	}

	public function compute() {
		while ($this->steps) {
			if (isset($this->instructions[$this->list->head->value])) {
				$func = $this->instructions[$this->list->head->value];
				$this->{$func}();
			}
			else {
				throw new Exception("Invalid instruction");
			}
			$this->steps--;
		}
	}

	public function addBtoEnd() {
		$this->list->push('B');
		$this->list->pop();
	}

	public function doNothing() {
		$this->list->pop();
		return;
	}

	public function add2AtoFront() {
		$node1 = new Link('A');
		$node2 = new Link('A');
		$node1->next = $node2;
		$node2->next = $this->list->head->next;
		$this->list->head = $node1;
		// We added 2 new nodes, and removes the head size = size + (2-1)
		$this->list->size++;
	}
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
	// Input: 0: Initial intruction. 1: Instructions to execute
  	array('input' => array('ABC', 4), 'expected' => 'ABB'),
  	array('input' => array('ABC', 7), 'expected' => 'B'),
);

foreach ($tests as $test) {
	$reader = new InstructionsReader($test['input'][0], $test['input'][1]);
	$reader->compute();
	$result = '';
	for ($i=0; $i < $reader->list->size ; $i++) { 
		$node = $reader->list->get($i);

		$result .= $node->value;
	}
	assert(
		$result == $test['expected'],
		json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
	);
}

print "All test passed. InstructionsReader works\n";