<?php 

/**
 * 1. Devise a hashing algorithm for strings.
 */

function getHash($str, $hashSize) {
	// Sum the ascii of every char of the string
	// and return the modulus of $hashsize
	$str_arr = str_split($str);
	$sum = 0;
	foreach ($str_arr as $char) {
		$sum += ord($char);
	}
	return $sum % $hashSize;
}


/**
 * 2. Calculate the probability of a collision occurring given the
 * number of buckets and number of elements in the hash set.
 */

function getCollisionProbability($numBuckets, $numElements) {
	// The ratio of number of total elements
	// and the number of buckets
	return (float) $numElements / $numBuckets;
}

/**
 * 3. Prove that the runtime of all the operations are O(1).
 */

/*

If the hash set is well distributed (the hash key are well generated/distributed)
the runtime of all operations are O(1). We have to set a good collision ration so
the hashSet resizes accordingly

Membership
	- Get linked list hash: 0(1)
	- Look for the element in the linked list: O(1) because increment of elements
	  in the hashSet the bucket numer increase accordingly (checking the collision ratio)
	  so the runtime is constant. Not the case for memory Big O!!

	Ex: 
		Collision Ratio = 0.5 / Initial buckets = 10
		10 Elements in hashSet => 20 buckets (10*2)
		100 Elements in hashSet => 320 buckets (10*2*2*2...)
		...

Insert
 	- Chech membership: O(1)
 	- Push linkedlist: O(1) EndNode->next = newNode => The size of the linked list does
 	  not matter.
Delete
	- Remove form linkedList: O(1) As mentioned above, because of the resize of the 
      hashSet buckets when the hashSet grows, the number os elements in the hashSet
      does not matter.
*/