<?php 

/**
 * Implementation of a hash set
 */

include_once './queue_linked_list.php';

class HashSet {
	public $buckets;
	public $bucketsSize = 10;
	public $size = 0;
	static $COLLISION_CHANCE = 0.3;

	public function __construct() {
		// Create buckets.
		$this->buckets = array();
		for ($i = 0; $i < $this->bucketsSize; $i++) {
			$this->buckets[$i] = new LinkedList();
		}
		$this->size = 0;
	}

	public function getHash($x, $hashSize) {
		// To test: Use modulus as hash function.
		// Using a good hasg function is really important
		// to the set to perform well.
		return $x % $hashSize;
	}

	public function resize() {
		// Double number of buckets.
		$newBucketsSize = $this->bucketsSize * 2;
		$newBuckets = array();

		// Create new buckets.
		for ($i = 0; $i < $newBucketsSize; $i++) {
			$newBuckets[$i] = new LinkedList();
		}

		// Copy elements over and use new hashes.
		for ($i = 0; $i < $this->bucketsSize; $i++) {
			for ($j = 0; $j < $this->buckets[$i]->size; $j++) {
				$el = $this->buckets[$i]->get($j);
				$newHash = $this->getHash($el->value, $newBucketsSize);
				$newBuckets[$newHash]->push($el->value);
			}
		}
		// Set new buckets.
		$this->buckets = $newBuckets;
		$this->bucketsSize = $newBucketsSize;
	}

	public function insert($x) {
		// Get hash of x.
		$hash = $this->getHash($x, $this->bucketsSize);

		// Get current bucket from hash.
		$curBucket = $this->buckets[$hash];

		// Stop, if current bucket already has x.
		if ($curBucket->contains($x)) {
			return FALSE;
		}
		// Otherwise, add x to the bucket.
		$curBucket->push($x);

		// Resize if the collision chance is higher than
		if ((float) $this->size / $this->bucketsSize > HashSet::$COLLISION_CHANCE) {
			$this->resize();
		}
		$this->size++;
		return TRUE;
	}

	public function remove($x) {
		// Get hash of x.
		$hash = $this->getHash($x, $this->bucketsSize);
		// Get bucket from hash.
		$curBucket = $this->buckets[$hash];
		// Remove x from bucket and return if operation successful.
		return $curBucket->deleteFirst($x);
	}

}
