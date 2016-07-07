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


