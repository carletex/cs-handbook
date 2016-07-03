<?php 
/**
 * 2. A game is played by always eliminating the kth player from
 * the last elimination and played until one player is left. Given
 * N players where each is assigned to a number, find the number
 * of the last remaining player.
 */

include_once './queue_linked_list.php';

class Game {
	public $players;
	public $kth;
	// Starting 0
	public $current_index;

	public function __construct($players_numbers, $kth) {
		$this->current_index = $kth - 1; 
		// Value of the kth member of the list
		$this->kth = $players_numbers[$kth - 1];
		$this->players = new LinkedList();
		foreach ($players_numbers as $i => $player_number) {
			if ($i != $this->current_index) {
				$this->players->push($player_number);
			}
		}
	}

	public function nextRound() {
		if ($this->players->size == 1) {
			return FALSE;
		}
		// We count the current element (-1)
		$index = ($this->kth - 1 + $this->current_index)  % $this->players->size;
		$this->current_index = $index;
		if ($index == 0) {
			// Remove the first element
			$ret = $this->players->pop();
		}
		else {
			// We want the previous one (-1) to call deleteNext()
			$prev = $this->players->get($index - 1);
			$ret = $prev->next;
			$this->players->deleteNext($prev);
		}
		return $ret;
	}

	public function getWinner() {
		if ($this->players->size != 1) {
			throw new Exception('The game is not over');
		}
		return $this->players->get(0);
	}

}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
  array('input' => array(array(1,2,3,4,5), 3), 'expected' => 4),
  array('input' => array(array(5,7,2,1), 2), 'expected' => 5),
  array('input' => array(array(1,5,8,9,10,2,4), 4), 'expected' => 5),
);

foreach ($tests as $test) {
	$game = new Game($test['input'][0], $test['input'][1]);
	while ($eliminated = $game->nextRound()) {continue;}
	$result = $game->getWinner();

	assert(
		$result->value === $test['expected'],
		json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result->value
	);
}

print "All test passed. the game works\n";

