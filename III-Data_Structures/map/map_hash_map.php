<?php 

/**
 * Implementation of a hash map
 */

include_once '../queue/queue_linked_list.php';

class Pair {
    public $key;
    public $value;
    
    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }
}
class HashMap {
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
        // Using a good hash function is really important
        // to the set, in order to perform well.
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
                $newHash = $this->getHash($el->value->key, $newBucketsSize);
                $newBuckets[$newHash]->push($el->value);
            }
        }
        // Set new buckets.
        $this->buckets = $newBuckets;
        $this->bucketsSize = $newBucketsSize;
    }

    public function put($key, $value) {
        // Get hash of x.
        $hash = $this->getHash($key, $this->bucketsSize);

        // Get current bucket from hash.
        $curBucket = $this->buckets[$hash];

        // Change value, if current bucket already has the key.
        for ($i = 0; $i < $curBucket->size ; $i++) { 
            if (($el = $curBucket->get($i)->value->key) == $key) {
                $el->value->value = $value;
                return FALSE;
            }
        }
        // Otherwise, add x to the bucket.
        $curBucket->push(new Pair($key, $value));

        // Resize if the collision chance is higher than
        if ((float) $this->size / $this->bucketsSize > HashMap::$COLLISION_CHANCE) {
            $this->resize();
        }
        $this->size++;
        return TRUE;
    }

    public function get($key) {
        $hash = $this->getHash($key, $this->bucketsSize);
        $curBucket = $this->buckets[$hash];
        for ($i = 0; $i < $curBucket->size ; $i++) { 
            $el = $curBucket->get($i);
            if ($el->value->key == $key) {
                return $el->value;
            }
        }
        return FALSE;
    }


    public function remove($key) {
        $hash = $this->getHash($key, $this->bucketsSize);
        $curBucket = $this->buckets[$hash];

        for ($i = 0; $i < $curBucket->size ; $i++) { 
            $el = $curBucket->get($i);
            if ($el->value->key == $key) {
                return $curBucket->deleteFirst($el->value);
            }
        }
        return FALSE;
    }

}
