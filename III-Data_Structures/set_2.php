<?php 

/**
 * 1. Given a list of words, determine how many of them are
 * anagrams of each other. An anagram is a word that can
 * have its letters scrambled into another word.
 *  • For example, silent and listen are anagrams but banana
 *    and orange are not.
 */

include_once './set_binary_search_tree.php';

function getMutualFriends($f1, $f2) {
    $tree = new BinarySearchTree();

    // Populate tree
    foreach ($f1 as $friend) {
        $tree->insert($friend);
    }
    $initialTreeSize = $tree->size;

    // Remove f2 from the tree
    foreach ($f2 as $friend) {
        $tree->remove($friend);
    }

    return $initialTreeSize - $tree->size;
}

/**
 * Tests
 */
assert_options(ASSERT_BAIL, 1);

$tests = array(
    array(
        'input' => array(
            array('carlos', 'luis', 'pedro', 'cristina', 'laura'),
            array('luis', 'carolina', 'patricia', 'pedro')
        ), 
        'expected' => 2
    ),
    array(
        'input' => array(
            array('carlos', 'luis', 'pedro', 'cristina', 'laura'),
            array('luis', 'cristina', 'carlos', 'laura', 'pedro'),
        ), 
        'expected' => 5
    ),
    array(
        'input' => array(
            array('carlos', 'luis', 'pedro', 'cristina', 'laura'),
            array('antonio', 'jim', 'victor'),
        ), 
        'expected' => 0
    ),
);

foreach ($tests as $test) {
    $result = getMutualFriends($test['input'][0], $test['input'][1]);
    assert(
        $result === $test['expected'],
        json_encode($test['input']) . ' expected ' . $test['expected'] . ' got ' . $result
    );
}

print "All test passed. getMutualFriends works\n";