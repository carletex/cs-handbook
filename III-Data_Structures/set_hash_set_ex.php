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